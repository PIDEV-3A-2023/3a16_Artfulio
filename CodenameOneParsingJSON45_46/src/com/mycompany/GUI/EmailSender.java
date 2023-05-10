package com.mycompany.GUI;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import com.codename1.util.Base64;


public class EmailSender {

    public static void sendEmail(String[] recipients, String subject, String content) {
    String senderEmail = "artfulio.manager@gmail.com"; // Replace with your sender email
    String senderPassword = "artfulio.manager2023"; // Replace with your sender password

    try {
        // Create a ConnectionRequest for sending the email
        ConnectionRequest request = new ConnectionRequest();
        request.setUrl("https://smtp.gmail.com:587");
        request.setPost(false);
        request.setContentType("text/plain");

        // Set the email headers
        request.addRequestHeader("Authorization", "Basic " + encodeBase64(senderEmail + ":" + senderPassword));
        request.addRequestHeader("From", senderEmail);
        request.addRequestHeader("To", joinRecipients(recipients));
        request.addRequestHeader("Subject", subject);

        // Set the email body
        request.setRequestBody(content);

        // Send the email
        NetworkManager.getInstance().addToQueueAndWait(request);

        System.out.println("Email sent successfully");
    } catch (Exception ex) {
        System.out.println("Failed to send email. Error message: " + ex.getMessage());
    }
}

private static String joinRecipients(String[] recipients) {
    StringBuilder builder = new StringBuilder();
    for (String recipient : recipients) {
        if (builder.length() > 0) {
            builder.append(",");
        }
        builder.append(recipient);
    }
    return builder.toString();
}
    
    private static String encodeBase64(String value) {
        byte[] bytes = value.getBytes();
        return com.codename1.util.Base64.encode(bytes);
    }
}
