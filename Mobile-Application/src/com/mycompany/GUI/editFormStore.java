/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;

/**
 *
 * @author Asus
 */
import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Store;
import com.mycompany.services.ServiceStore;


public class editFormStore extends BaseForm {

    ServiceStore service = new ServiceStore();
    public editFormStore(Store e) throws ParseException {
        this.init(Resources.getGlobalResources());
        float prix = e.getPrix_artwork();
TextField prixField = new TextField(Float.toString(prix), "prix");
        TextField nomField = new TextField(e.getNom_artwork(), "nom");
      TextField imgField = new TextField(e.getImg_artwork(), "img");
        this.add(nomField);
        this.add(imgField);
        this.add(prixField);
        Button submitButton = new Button("Submit");
        submitButton.addActionListener(s-> {
            String nom = nomField.getText();
            String img = imgField.getText();
            

            Store store = new Store();
            
            store.setId_produit(e.getId_piece_art());
            store.setNom_artwork(nom);
            store.setPrix_artwork(prix);
            store.setImg_artwork(img);
            
            service.editStore(store);
            getStoreForm myForm = new getStoreForm();
            myForm.show();
        }
        );
        Button goToFormButton = new Button("Go back");
        goToFormButton.addActionListener(ee -> {
            getStoreForm myForm = new getStoreForm();
            myForm.show();
        });
        Button deleteButton = new Button("Delete");
        deleteButton.addActionListener(cc -> {
            service.delStore(e);
            getStoreForm myForm = new getStoreForm();
            myForm.show();
        });
        this.add(deleteButton);
        this.add(goToFormButton);
        this.add(submitButton);
    }

}