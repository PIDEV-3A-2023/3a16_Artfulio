package com.mycompany.GUI;

import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.FontImage;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Categorie;
import com.mycompany.services.CategorieWebService;

public class editFormCategorie extends BaseForm {

    CategorieWebService service = new CategorieWebService();
    public editFormCategorie(Categorie e) throws ParseException {
            setTitle("Modifier Categorie");

        this.init(Resources.getGlobalResources());
        TextField nomField = new TextField(e.getName(), "nom");
        TextField typeField = new TextField(e.getType(), "type");
        this.add(nomField);
        this.add(typeField);
        Button submitButton = new Button("Submit");
        submitButton.addActionListener(s-> {
            String nom = nomField.getText();
            String slug = typeField.getText();

            Categorie categorie = new Categorie();
            categorie.setId(e.getId());
            categorie.setName(nom);
            categorie.setType(slug);
            
            service.editCategorie(categorie);
            getCategorieForm myForm = new getCategorieForm();
            myForm.show();
        }
        );
        Button goToFormButton = new Button("Go back");
        goToFormButton.addActionListener(ee -> {
            getCategorieForm myForm = new getCategorieForm();
            myForm.show();
        });
        Button deleteButton = new Button("Delete");
        deleteButton.addActionListener(cc -> {
            service.delCategorie(e);
            getCategorieForm myForm = new getCategorieForm();
            myForm.show();
        });
        this.add(deleteButton);
        this.add(goToFormButton);
        this.add(submitButton);
            getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> new getCategorieForm().showBack());

    }

}
