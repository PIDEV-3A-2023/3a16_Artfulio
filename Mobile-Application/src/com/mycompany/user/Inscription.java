/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.user;

import com.codename1.components.FloatingHint;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Utilisateur;
import com.mycompany.services.ServiceUtlisateur;
import java.util.Vector;

/**
 *
 * @author user
 */
public class Inscription extends BaseForm {

    public Inscription(Resources res) {
        super(new BorderLayout());
        Toolbar tb = new Toolbar(true);
        setToolbar(tb);
        tb.setUIID("Container");
        getTitleArea().setUIID("Container");
        Form previous = Display.getInstance().getCurrent();
        tb.setBackCommand("", e -> previous.showBack());
        setUIID("SignIn");

        TextField username = new TextField("", "Username", 20, TextField.ANY);
        TextField cin_user = new TextField("", "Cin", 20, TextField.ANY);
        TextField email = new TextField("", "E-Mail", 20, TextField.EMAILADDR);
        TextField password = new TextField("", "Password", 20, TextField.PASSWORD);
        TextField adresse_user = new TextField("", "Adresse", 20, TextField.ANY);
        //Role 
        //Vector 3ibara ala array 7atit fiha roles ta3na ba3d nzidouhom lel comboBox
        Vector<String> vectorRole;
        vectorRole = new Vector();

        vectorRole.add("Client");
        vectorRole.add("Artiste");
        ComboBox<String> roles = new ComboBox<>(vectorRole);

        username.setSingleLineTextArea(false);

        cin_user.setSingleLineTextArea(false);
        email.setSingleLineTextArea(false);
        password.setSingleLineTextArea(false);
        adresse_user.setSingleLineTextArea(false);
        Button next = new Button("Ajouter");
        Button signIn = new Button("Sign In");
        signIn.addActionListener(e -> new SignInForm(res).show());
        signIn.setUIID("Link");

        Container content = BoxLayout.encloseY(
                new Label("Ajouter", "LogoLabel"),
                new FloatingHint(username),
                createLineSeparator(),
                new FloatingHint(cin_user),
                createLineSeparator(),
                new FloatingHint(email),
                createLineSeparator(),
                new FloatingHint(password),
                createLineSeparator(),
                new FloatingHint(adresse_user),
                createLineSeparator(),
                roles
        );
        content.setScrollableY(true);
        add(BorderLayout.CENTER, content);
        add(BorderLayout.SOUTH, BoxLayout.encloseY(
                next
        ));
        next.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                if ((username.getText().length() == 0)) {
                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));
                } else {
                    try {

                            Utilisateur u = new Utilisateur(username.getText().toString(), cin_user.getText().toString(), email.getText().toString(), password.getText().toString(), roles.getSelectedItem().toString(), adresse_user.getText().toString());
                        if (ServiceUtlisateur.getInstance().addUser(u)) {
                            Dialog.show("Success", "Connection accepted", new Command("OK"));
                        } else {
                            Dialog.show("ERROR", "Server error", new Command("OK"));
                        }
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
                    }

                }

            }
        });

    }

}
