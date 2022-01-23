<?php 
include_once('../../app.php');

if (isset($_POST))
{
    $obj = new CommandSpa();
    $obj->connect();

    // "name=John&email=john%40cs.com&subject=I%20love%20CommandSpa&message=I%20want%20100%20CommandSpa%20units."

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']))
    {
        $customerContactObj = new stdClass();
        $customerContactObj->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $customerContactObj->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $customerContactObj->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $customerContactObj->message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $obj->store_customer_contact($customerContactObj);
        $obj->send_customer_contact_form_email($customerContactObj);
        echo 'OK';
    }

    session_write_close();
    $obj->closeDB();
}

?>
