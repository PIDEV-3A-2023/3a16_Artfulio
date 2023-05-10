/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;

import com.codename1.ui.CheckBox;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextArea;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.list.DefaultListModel;
import com.codename1.ui.list.MultiList;
import com.codename1.ui.util.Resources;

import com.mycompany.entities.Reclamation;
import com.mycompany.GUI.*;
import com.mycompany.services.ServiceReclamation;
import com.codename1.ui.Button;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.util.Resources;
import java.util.ArrayList;

import java.util.ArrayList;

/**
 *
 * @author Andrew
 */
public class ListReclamations extends Form {

    private TextField searchField;
    private Button searchButton;

    public ListReclamations(Form previous) {
        setTitle("Liste des Reclamation");
        setLayout(BoxLayout.y());
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

        // Create the search bar and search button
        searchField = new TextField("", "Chercher avec email");
        searchButton = new Button("Chercher");

        // Add an ActionListener to the search button
        searchButton.addActionListener(e -> {
            String searchEmail = searchField.getText();
            filterTasks(searchEmail, previous);
        });

        // Add the search bar and button to the form
        Container searchContainer = BoxLayout.encloseX(searchField, searchButton);
        add(searchContainer);

        ArrayList<Reclamation> tasks = ServiceReclamation.getinstance().getAllTasks();
        for (Reclamation t : tasks) {
            addElement(t, previous);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());
    }

    private void filterTasks(String searchEmail, Form previous) {
        removeAll();

        ArrayList<Reclamation> tasks = ServiceReclamation.getinstance().getTasksByEmail(searchEmail);
        if (tasks.isEmpty()) {
            // Show a message when no match is found
            Label noMatchLabel = new Label("Aucun résultat trouvé");
            add(noMatchLabel);
        } else {
            // Display the matched tasks
            for (Reclamation t : tasks) {
                addElement(t, previous);
            }
        }

        revalidate();
    }

    public void addElement(Reclamation t, Form previous) {
        TextArea textArea = new TextArea(t.getIdRec() + " - " + t.getTitre() + " - " + t.getReclamationSec() + " - " + t.getEmail());
        textArea.setEditable(false);
        textArea.setUIID("Label"); // Set UIID to make it look like a label
        textArea.setRows(2); // Adjust the number of rows as needed
        add(textArea);

        Button editButton = new Button("Modifier");
        editButton.addActionListener(e -> editTask(t, previous));
        add(editButton);
    }

    private void editTask(Reclamation t, Form previous) {
        // Create the edit form
        Form editForm = new Form();
        editForm.setTitle("Modifier");
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

        // Create text fields with the current values
        TextField idField = new TextField(String.valueOf(t.getIdRec()), "id Rec");
        TextField titreField = new TextField(t.getTitre(), "Titre");
        TextField recsecField = new TextField(t.getReclamationSec(), "Reclamation Sec");
        TextField emailField = new TextField(t.getEmail(), "Email");

        // Create the update button
        Button updateButton = new Button("MAJ");

        updateButton.addActionListener(e -> {
            // Get the current values from the text fields
            String newidtxt = idField.getText();
            String newTitre = titreField.getText();
            String newRecsec = recsecField.getText();
            String newEmail = emailField.getText();

            int newId = Integer.parseInt(newidtxt);

            // Check for empty fields and minimum length requirements
            if (newTitre.length() == 0 || newRecsec.length() == 0 || newEmail.length() == 0) {
                Dialog.show("Alert", "Please fill in all the fields", "OK", null);
                return; // Exit the actionPerformed method without updating the task
            } else if (newTitre.length() < 15) {
                Dialog.show("Alert", "Please enter at least 15 characters for 'Titre'", "OK", null);
                return; // Exit the actionPerformed method without updating the task
            } else if (newRecsec.length() < 100) {
                Dialog.show("Alert", "Please enter at least 100 characters for 'ReclamationSec'", "OK", null);
                return; // Exit the actionPerformed method without updating the task

            }

            // Check if the values are the same as the original attributes
            if (newTitre.equals(t.getTitre()) && newRecsec.equals(t.getReclamationSec()) && newEmail.equals(t.getEmail())) {
                Dialog.show("Warning", "No changes made to the task", "OK", null);
                return; // Exit the actionPerformed method without updating the task
            }

            // Update the task with the new values
            t.setIdRec(newId);
            t.setTitre(newTitre);
            t.setReclamationSec(newRecsec);
            t.setEmail(newEmail);

            // Call the editTask function to update the task
            boolean success = ServiceReclamation.getinstance().editTask(t);
            if (success) {
                Dialog.show("Success", "Reclamation updated successfully", "OK", null);
                previous.show();
            } else {
                Dialog.show("Error", "Failed to update Reclamation", "OK", null);
            }
        });

        // Create the delete button
        Button deleteButton = new Button("Supprimer");
        deleteButton.addActionListener(e -> {
            // Call the deleteTask function to delete the task
            boolean success = ServiceReclamation.getinstance().deleteTask(t.getIdRec());
            if (success) {
                Dialog.show("Success", "Reclamation deleted successfully", "OK", null);
                previous.show();
            } else {
                Dialog.show("Error", "Failed to delete Reclamation", "OK", null);
            }
        });

        // Add components to the edit form
        editForm.setLayout(BoxLayout.y());
        editForm.addAll(titreField, recsecField, emailField, updateButton, deleteButton);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

        // Show the edit form
        editForm.show();
    }

}
