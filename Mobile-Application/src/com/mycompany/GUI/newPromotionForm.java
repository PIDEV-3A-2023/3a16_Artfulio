package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Promotion;

import com.mycompany.services.PromotionWebService;

public class newPromotionForm extends BaseForm {

    public newPromotionForm() {
        this.init(Resources.getGlobalResources());
        
        TextField nomField = new TextField("", "remise");
        TextField typeField = new TextField("", "type");
        TextField idArtField = new TextField("", "id_artwork");
        TextField nom_artworkField = new TextField("", "nom_artwork");
        TextField prix_artworkField = new TextField("", "prix_artwork");
        
        this.add(nomField);
        this.add(typeField);
        this.add(idArtField);
        this.add(nom_artworkField);
        this.add(prix_artworkField);

        Button submitButton = new Button("Ajouter");

        submitButton.addActionListener(s
                -> {
            
            String remise = nomField.getText();
            String type = typeField.getText();
            String id_artwork = idArtField.getText();
            String nom_artwork = nom_artworkField.getText();
            String prix_artwork = prix_artworkField.getText();

            Promotion promotion = new Promotion();
            
            promotion.setRemise(Integer.valueOf(remise));
            promotion.setType(type);
            promotion.setId_artwork(Integer.valueOf(id_artwork));
            promotion.setNom_artwork(nom_artwork);
            promotion.setPrix_artwork(prix_artwork);
            
            PromotionWebService service = new PromotionWebService();
            service.newPromotion(promotion);
            getPromotionForm myForm = new getPromotionForm();
            myForm.show();
        }
        );
        this.add(submitButton);
        Button goToFormButton = new Button("Go Back");
        goToFormButton.addActionListener(e -> {
            getPromotionForm myForm = new getPromotionForm();
            myForm.show();
        });
        this.add(goToFormButton);
    }

}
