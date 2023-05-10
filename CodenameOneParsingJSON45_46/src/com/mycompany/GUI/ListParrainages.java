package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.entities.Parrainage;
import com.mycompany.services.ServiceParrainage;
import java.util.ArrayList;

public class ListParrainages extends Form {

    private TextField searchField;
    private Button searchButton;

    public ListParrainages(Form previous) {
        setTitle("Liste des Parrainages");
        setLayout(BoxLayout.y());

        // Create the search bar and search button
        searchField = new TextField("", "Chercher avec idUser");
        searchButton = new Button("Chercher");

        // Add an ActionListener to the search button
        searchButton.addActionListener(e -> {
            String searchIdUserText = searchField.getText();
            if (!searchIdUserText.isEmpty()) {
                int searchIdUser = Integer.parseInt(searchIdUserText);
                filterParrainages(searchIdUser, previous);
            } else {
                Dialog.show("Erreur", "Veuillez saisir un idUser valide", "OK", null);
            }
        });

        // Add the search bar and button to the form
        addAll(searchField, searchButton);

        ArrayList<Parrainage> parrainages = ServiceParrainage.getInstance().getAllParrainages();
        for (Parrainage p : parrainages) {
            addElement(p, previous);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());
    }

    private void filterParrainages(int searchIdUser, Form previous) {
        removeAll();

        ArrayList<Parrainage> parrainages = ServiceParrainage.getInstance().getParrainageByidUser(searchIdUser);
        if (parrainages.isEmpty()) {
            // Show a message when no match is found
            Label noMatchLabel = new Label("Aucun résultat trouvé");
            add(noMatchLabel);
        } else {
            // Display the matched parrainages
            for (Parrainage p : parrainages) {
                addElement(p, previous);
            }
        }

        revalidate();
    }

    public void addElement(Parrainage p, Form previous) {
        TextField idUserField = new TextField(String.valueOf(p.getIdUser()));
        idUserField.setEditable(false);
        add(idUserField);

        Button editButton = new Button("Modifier");
        editButton.addActionListener(e -> editParrainage(p, previous));
        add(editButton);
    }

    private void editParrainage(Parrainage p, Form previous) {
        // Create the edit form
        Form editForm = new Form();
        editForm.setTitle("Modifier");

        // Create the idUser text field with the current value
        TextField idUserField = new TextField(String.valueOf(p.getIdUser()), "idUser");
        idUserField.setEditable(false);

        // Create the update button
        Button updateButton = new Button("MAJ");

        updateButton.addActionListener(e -> {
            // Get the current idUser value
            String newIdUserText = idUserField.getText();

            // Check for empty field
            if (newIdUserText.length() == 0)
{
                Dialog.show("Alert", "Please fill in the idUser field", "OK", null);
                return; // Exit the actionPerformed method without updating the parrainage
            }

            // Check if the idUser is the same as the original idUser
            if (newIdUserText.equals(String.valueOf(p.getIdUser()))) {
                Dialog.show("Warning", "No changes made to the parrainage", "OK", null);
                return; // Exit the actionPerformed method without updating the parrainage
            }

            // Parse the new idUser
            int newIdUser = Integer.parseInt(newIdUserText);

            // Update the parrainage with the new idUser
            p.setIdUser(newIdUser);

            // Call the updateParrainage function to update the parrainage
            boolean success = ServiceParrainage.getInstance().updateParrainage(p);
            if (success) {
                Dialog.show("Success", "Parrainage updated successfully", "OK", null);
                previous.show();
            } else {
                Dialog.show("Error", "Failed to update Parrainage", "OK", null);
            }
        });

        // Create the delete button
        Button deleteButton = new Button("Supprimer");
        deleteButton.addActionListener(e -> {
            // Call the deleteParrainage function to delete the parrainage
            boolean success = ServiceParrainage.getInstance().deleteParrainage(p.getIdParrainage());
            if (success) {
                Dialog.show("Success", "Parrainage deleted successfully", "OK", null);
                previous.show();
            } else {
                Dialog.show("Error", "Failed to delete Parrainage", "OK", null);
            }
        });

        // Add components to the edit form
        editForm.setLayout(BoxLayout.y());
        editForm.addAll(idUserField, updateButton, deleteButton);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

        // Show the edit form
        editForm.show();
    }
}