package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.entities.Parrainage;
import com.mycompany.entities.User;
import com.mycompany.services.ServiceParrainage;

import java.util.ArrayList;
import java.util.List;

public class addParrainage extends Form {

    private User user;

    public addParrainage(Form previous) {
        this.user = user;

        setTitle("Ajouter une demande de parrainage");
        setLayout(BoxLayout.y());

        Button btnAdd = new Button("Add Parrainage");
        btnAdd.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                if (user == null) {
                    Dialog.show("Error", "Please sign in to use this feature", "OK", null);
                } else {
                    // Retrieve the list of parrainages
                    List<Parrainage> parrainages = ServiceParrainage.getInstance().getAllParrainages();

                    // Check if idUser already exists in the Parrainage list
                    boolean userExists = false;
                    for (Parrainage parrainage : parrainages) {
                        if (parrainage.getIdUser() == user.getIdUser()) {
                            userExists = true;
                            break;
                        }
                    }

                    if (userExists) {
                        Dialog.show("Error", "You already have a parrainage request", "OK", null);
                    } else {
                        // Create Parrainage object
                        Parrainage parrainage = new Parrainage();
                        parrainage.setIdUser(user.getIdUser());

                        // Add the Parrainage
                        if (ServiceParrainage.getInstance().addParrainage(parrainage)) {
                            Dialog.show("Success", "Parrainage added successfully", "OK", null);
                        } else {
                            Dialog.show("Error", "Failed to add Parrainage", "OK", null);
                        }
                    }
                }
            }
        });

        add(btnAdd);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());
    }

}
