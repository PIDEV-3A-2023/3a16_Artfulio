package tn.gestion.artfulio.forms;

import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import tn.gestion.artfulio.entites.Promotion;
import tn.gestion.promotion.service.PromotionWebService;

public class editFormPromotion extends BaseForm {

    PromotionWebService service = new PromotionWebService();
    public editFormPromotion(Promotion p) throws ParseException {
        this.init(Resources.getGlobalResources());
        
        TextField nomField = new TextField(p.getRemise()+"", "remise");
        TextField typeField = new TextField(p.getType(), "type");
        TextField idArtField = new TextField(p.getId_artwork()+"", "id_artwork");
        TextField nom_artworkField = new TextField(p.getNom_artwork()+"", "nom_artwork");
        TextField prix_artworkField = new TextField( p.getPrix_artwork()+"", "prix_artwork");
        
        this.add(nomField);
        this.add(typeField);
        this.add(idArtField);
        this.add(nom_artworkField);
        this.add(prix_artworkField);
        
        Button submitButton = new Button("Update");
        submitButton.addActionListener(s-> {
            String remise = nomField.getText();
            String type = typeField.getText();
            String id_artwork = idArtField.getText();
            String nom_artwork = nom_artworkField.getText();
            String prix_artwork = prix_artworkField.getText();

            Promotion promotion = new Promotion();
            
            promotion.setId(p.getId());
            promotion.setRemise(Integer.valueOf(remise));
            promotion.setType(type);
            promotion.setId_artwork(Integer.valueOf(id_artwork));
            promotion.setNom_artwork(nom_artwork);
            promotion.setPrix_artwork(prix_artwork);
            
            service.editPromotion(promotion);
            getCategorieForm myForm = new getCategorieForm();
            myForm.show();
        }
        );
        Button goToFormButton = new Button("Go back");
        goToFormButton.addActionListener(ee -> {
            getPromotionForm myForm = new getPromotionForm();
            myForm.show();
        });
        Button deleteButton = new Button("Delete");
        deleteButton.addActionListener(cc -> {
            service.delPromotion(p);
            getPromotionForm myForm = new getPromotionForm();
            myForm.show();
        });
        this.add(deleteButton);
        this.add(goToFormButton);
        this.add(submitButton);
    }

}
