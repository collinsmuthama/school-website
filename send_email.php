<?php
header('Content-Type');

    // Include PHPMailer classes
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {                                                                                                                                                                                             

        $f_name = htmlspecialchars($_POST['fname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);   
        $county  = htmlspecialchars($_POST['county']);
        $subcounty  =  htmlspecialchars($_POST['subcounty']);
        $class = $_POST['class'];
        $school = $_POST['school'];
        $marks = htmlspecialchars($_POST['marks']);
        $type =  $_POST['type'];
        $category = $_POST['category'];
        $occupation = htmlspecialchars($_POST['occupation']);
        $scholarship = $_POST['scholarship'];
        $message = htmlspecialchars($_POST['message']); 

        //handle attachment
        $hasFile = isset($_FILES['transcript']) && $_FILES['transcript']['error'] == UPLOAD_ERR_OK;

        if($hasFile) {
            $file_tmp = $_FILES['transcript']['tmp_name'];
            $file_name = $_FILES['transcript']['name'];
            $file_size = $_FILES['transcript']['size'];
            $file_type = $_FILES['transcript']['type'];
            $file_content = chunk_split(base64_decode(file_get_contents($file_tmp)));
            $boundary = md5(time());
        }

        if (  empty($f_name) || empty($email) || empty($phone) || empty($county) || empty($subcounty) || empty($class) ||
              empty($school) || empty($marks) || empty($type) || empty($category) || empty($occupation)||empty($scholarship) || empty($message)
           ) {
                echo json_encode(['message' => 'All fields are required.']);
                http_response_code(400);
                exit;
             } 

             $mail =  new PHPMailer(true);
                 try {
                //SMTP set up
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username  = 'mmuthamacollins90@gmail.com';
                $mail->Password = 'vwhv azvq jevk ygux';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //sender and receiver
                $mail->isHTML(true);
                $mail->setFrom($email,$f_name);
                $mail->addAddress($mail->Username);
                //email content
                $mail->Subject = 'NEW ADMISSION FORM';
                $mail->Body = '<table style="border-collapse: collapse; width: 60%; font-family: Arial, sans-serif;">'.
                                    '<thead>'.
                                        '<tr>'.
                                            '<th  colspan="2" style="border: 1px solid #ccc; padding: 10px; background-color: green; color: white">STUDENT DETAILS AS CAPTURED FROM THE SYSTEM</th>'.
                                         '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Name</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$f_name.'<td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th  style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Phone</th>'.
                                             '<td style="border: 1px solid #ccc; padding: 10px;">'.$phone.'<td>'.
                                        '<tr/>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">County</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$county.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Sub County</th>'.
                                             '<td style="border: 1px solid #ccc; padding: 10px;">'.$subcounty.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Grade</th>'.
                                             '<td style="border: 1px solid #ccc; padding: 10px;">'.$class.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">School</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$school.'</td>'.
                                        '</tr>'.
                                        '<tr>'. 
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">KCPE Marks</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$marks.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Are you an Orphan ?</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$type.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:350px" >Orphan Type</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$category.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:450px">Guardian Occupation</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$occupation.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:150px">Scholarship Type</th>'.
                                            ' <td style="border: 1px solid #ccc; padding: 10px;">'.$scholarship.'</td>'.
                                        '</tr>'.
                                        '<tr>'.
                                            '<th style="border: 1px solid #ccc; padding: 10px; background-color: #f2f2f2; color: #333;width:550px">Why do you need scholarship?</th>'.
                                            '<td style="border: 1px solid #ccc; padding: 10px;">'.$message.'</td>'.
                                        '<tr>'.
                                    '</thead>'.
                                '</table>';

                if ($_FILES['transcript']['tmp_name']  && $_FILES['transcript']['error'] == UPLOAD_ERR_OK) {
                    $mail->addAttachment( $_FILES['transcript']['tmp_name'], $_FILES['transcript']['name']);
                }
                $mail->send();
                echo json_encode(['message' => 'Your message has been sent successfully!']);
                return;

            } catch (Exception $e) {
                echo json_encode(['message' => 'Failed to send your message.'.$mail->ErrorInfo]);
                return;
            }

    } else {
        echo json_encode(['message' => 'Failed to send your message.']);
        return;
    }

?>                                                                                         