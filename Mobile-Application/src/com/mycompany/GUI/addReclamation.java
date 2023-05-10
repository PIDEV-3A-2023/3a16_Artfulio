/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.entities.Reclamation;
import com.mycompany.services.ServiceReclamation;

/**
 *
 * @author Andrew
 */
public class addReclamation extends Form {

    public addReclamation(Form previous) {

        setTitle("Ajouter une réclamation");
        setLayout(BoxLayout.y());
        TextField tftitre = new TextField("", "Titre");
        TextField tfrecsec = new TextField("", "ReclamationSec");
        TextField tfemail = new TextField("", "email");
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

        Button btnadd = new Button("add Task");

        btnadd.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {

                if (tftitre.getText().length() == 0 || tfrecsec.getText().length() == 0 || tfemail.getText().length() == 0) {
                    Dialog.show("Alert", "Please fill in all the fields", "OK", null);
                } else if (tftitre.getText().length() < 15) {
                    Dialog.show("Alert", "Please enter at least 15 characters for 'tftitre'", "OK", null);
                } else if (tfrecsec.getText().length() < 200) {
                    Dialog.show("Alert", "Please enter at least 200 characters for 'tfrecsec'", "OK", null);

                } else {

                    Reclamation tas = new Reclamation(tftitre.getText(), tfrecsec.getText(), tfemail.getText());
                    if (ServiceReclamation.getinstance().addTask(tas)) {
                        Dialog.show("Alert", "added successfuly", "ok", null);

                        String recipientEmail = tfemail.getText();
                        String[] recipientEmails = {recipientEmail, "daadsoufi01@gmail.com"};
                        String subject = "New Reclamation";
                        String content = "A new reclamation has been created.\n\nReclamation Details:\n" + tfrecsec.getText();

                        EmailSender.sendEmail(recipientEmails, subject, content);

                    } else {
                        Dialog.show("Alert", "Err while connecting to server ", "ok", null);
                    }

                }
            }
        });

        addAll(tftitre, tfrecsec, tfemail, btnadd);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

    }

}
