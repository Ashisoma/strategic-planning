<?php

namespace Controllers\Utils;

use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use PHPMailer\PHPMailer\PHPMailer;

class Utility {

    /***
     * Checks for missing attributes
     * @param array $data
     * @param array $attributes
     *
     * @return array - an array of missing attrs
     */
    public static function checkMissingAttributes(array $data, array $attributes): array
    {
        $missingAttrs = [];
        foreach ($attributes as $attribute) {
            if (!isset($data[$attribute])) array_push($missingAttrs, $attribute);
        }
        return $missingAttrs;

    }

    /***
     * Builds an excel sheet for downloading
     * @param String $name The name of the file to be built
     * @param string[] $headers The headers of the sheet
     * @param string[] $attributes The attributes contained in the data
     * @param array $data An Array containing the data to be loaded in the excel
     *
     * Note The length of these arrays i.e. $headers, $attributes should be the same
     *
     */
    public static function buildExcel($name, $headers, $attributes, $data)
    {
        try {
            if (sizeof($headers)  != sizeof($attributes))
                throw new \Exception("Invalid Data Passed", -1);

            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile($name);


            $boldRowStyle = (new StyleBuilder())
                ->setFontBold()
                ->setFontSize(12)
                ->setFontUnderline()
                ->setCellAlignment(CellAlignment::CENTER)
                ->build();

            $normalRowStyle = (new StyleBuilder())
                ->setFontSize(10)
                ->setCellAlignment(CellAlignment::CENTER)
                ->build();

            $headerCells = [];
            for ($i = 0; $i < sizeof($headers); $i++){
                $header = $headers[$i];
                array_push($headerCells, WriterEntityFactory::createCell($header));
            }
            $headerRow = WriterEntityFactory::createRow($headerCells, $boldRowStyle);
            $writer->addRow($headerRow);
            foreach ($data as $datum){
                if (sizeof($datum) != sizeof($attributes))
                    throw new \Exception("Attributes mismatch. " . $i, -1);
                $datumCells = [];
                for ($i = 0; $i < sizeof($datum); $i++){
                    $m = WriterEntityFactory::createCell($datum[$attributes[$i]]);
                    array_push($datumCells, $m);
                }
                $writer->addRow(WriterEntityFactory::createRow($datumCells, $normalRowStyle));
            }
            $writer->openToBrowser($name);
            $writer->close();
            unlink($name);

        }catch (\Throwable $e){
            Utility::logError($e->getCode(), $e->getMessage());
            echo $e->getMessage();
        }
    }

    public static function logError($code, $message)
    {
        if (!is_dir($_ENV['LOGS_DIR'])) {
            mkdir($_ENV['LOGS_DIR']);
        }
        $handle = fopen($_ENV['LOGS_DIR'] . "errors.txt", 'a');
        $data = date("Y-m-d H:i:s ", time());
        $data .= "      Code " . $code;
        $data .= "      Message " . $message;
        $data .= "      ClientAddr " . $_SERVER["REMOTE_ADDR"];
        $data .= "\n";
        fwrite($handle, $data);
        fclose($handle);
    }

    /****
     * Sends an email
     * @test 
     */
    public static function sendMailTest()
    {
        try {
            $mail = new PHPMailer();
            //Server settings
            $mail->SMTPDebug = false;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $_ENV['MAIL_HOST'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_ENV['MAIL_SENDER']; //                     //SMTP username
            $mail->Password   = $_ENV['MAIL_SENDER_PASSWORD'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->protocol   = 'mail';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($_ENV['MAIL_SENDER'], 'Fleet System');
            $mail->addAddress('kimjose693@gmail.com', 'Joe User');     //Add a recipient
            $mail->addAddress('jkimani@chskenya.org', 'Joe User');     //Add a recipient
            $mail->addAddress('jwambui@chskenya.org', 'Joe User');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            //send the message, check for errors
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
            }
        } catch (\Throwable $th) {
            self::logError($th->getCode(), $th->getMessage());
        }
    }

    /**
     * @param models\User[] $recipients Users to receive the email
     * @param String $subject The subject of the email
     * @param String $message The message string of the email
     * 
     * @return bool Returns true if the email is sent successfully
     */
    public static function sendMail($recipients, $subject, $message):bool {
        try {
            $mail = new PHPMailer();
            //Server settings
            $mail->SMTPDebug = false;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $_ENV['MAIL_HOST'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $_ENV['MAIL_SENDER']; //                     //SMTP username
            $mail->Password   = $_ENV['MAIL_SENDER_PASSWORD'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->protocol   = 'mail';                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($_ENV['MAIL_SENDER'], 'Fleet System');
            foreach ($recipients as $recipient){
                $mail->addAddress($recipient->email, $recipient->names);
            }
            //$mail->addAddress('kimjose693@gmail.com', 'Joe User');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            //send the message, check for errors
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        } catch (\Throwable $th) {
            self::logError($th->getCode(), $th->getMessage());
            return false;
        }
    }


}