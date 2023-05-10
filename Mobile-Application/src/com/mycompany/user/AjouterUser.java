/*
 * Copyright (c) 2016, Codename One
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions 
 * of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
 */
package com.mycompany.user;

import com.codename1.components.FloatingHint;
import com.codename1.components.InfiniteProgress;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
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
 * Signup UI
 *
 * @author Shai Almog
 */
public class AjouterUser extends BaseForm {

    public AjouterUser(Resources res) {
        super(new BorderLayout());
        Toolbar tb = new Toolbar(true);
        setToolbar(tb);
        tb.setUIID("Container");
        getTitleArea().setUIID("Container");
        Form previous = Display.getInstance().getCurrent();
        tb.setBackCommand("", e -> previous.showBack());
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
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

        vectorRole.add("Admin");
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
                if (!containsNumber(username.getText()) && !containsNumber(cin_user.getText()) && (password.getText().length() > 8)) {
                    {

                        try {

                            Utilisateur u = new Utilisateur(username.getText().toString(), cin_user.getText().toString(), email.getText().toString(), password.getText().toString(), roles.getSelectedItem().toString(), adresse_user.getText().toString());
                            if (ServiceUtlisateur.getInstance().addUser(u)) {
                                {
                                    InfiniteProgress ip = new InfiniteProgress();
                                    final Dialog ipDialog = ip.showInfiniteBlocking();

                                    ipDialog.dispose();
                                    Dialog.show("Success", "Utilisateur ajoutée", new Command("OK"));
                                    new GestionUser(res).show();
                                }
                            } else {
                                Dialog.show("ERROR", "Server error", new Command("OK"));
                            }
                        } catch (NumberFormatException e) {
                            Dialog.show("ERROR", "Status must be a number", new Command("OK"));
                        }

                    }
                } else {
                    // Données invalides - afficher un message d'erreur
                    Dialog.show("Erreur", "Le donnés sont invalide", "OK", null);
                }

            }
        });

    }

    private boolean containsNumber(String str) {
        for (int i = 0; i < str.length(); i++) {
            if (Character.isDigit(str.charAt(i))) {
                return true;
            }
        }
        return false;
    }

    public boolean containsOnlyDigits(String str) {
        for (int i = 0; i < str.length(); i++) {
            if (!Character.isDigit(str.charAt(i))) {
                return false;
            }
        }
        return true;
    }
}
