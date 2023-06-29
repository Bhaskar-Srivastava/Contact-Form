<html>
<head>
<title>Contact Form</title>
<link rel="stylesheet" href="contact.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="contact-form">
<h2>Contact Us</h2>
<form method="Post" action="">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="text" name="phone" placeholder="Phone No" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>

    <div class="g-recaptcha" data-sitekey="6LeOrd0mAAAAAP12InPkKZ1kF39VyuMk1w1LdwDb"></div>

     <input type="submit" name="submit" value="Send Message" class="submit-btn">
</form>

<div class="status">
                
<?php
  if(isset($_POST['submit']))
  {
        $User_name = $_POST['name'];
        $phone = $_POST['phone'];
        $User_email = $_POST['email'];
        $User_message = $_POST['message'];


        $email_from = 'achsuraj2015@gmail.com';
        $email_subject = "New Form Submission";
        $email_body = "Name: $User_name.\n".
                      "Phone No: $phone.\n".
                      "Email id: $User_email.\n".
                      "User Message: $User_message.\n";

        $to_email = "bhaskarsrivastava2015@gmail.com";
        $headers = "From $email_from\r\n";
        $headers = "Reply-To: $User_email\r\n";
                
                
        $secretkey = "6LeOrd0mAAAAAOeiK4nM3xub4gyCyAEg6W8n6aKm";
        $responseKey = $_POST['g-recaptcha-response'];
        $UserIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$responseKey&remoteip=$UserIP";

        $response = file_get_contents($url);
        $response = json_decode($response);

        if ($response->success)
        {
            mail($to_email,$email_subject,$email_body,$headers);
            echo "Message Sent Successfully";
        }
        else{
            echo "<span>Invalid Captcha, Please try Again</span>";
        }
    }
    ?>
    </div>
    </div>
    </body>
    </html>