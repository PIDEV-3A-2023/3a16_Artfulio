package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Categorie;
import com.mycompany.services.CategorieWebService;

public class newCategorieForm extends BaseForm {

    public newCategorieForm() {
                    setTitle("Ajouter Categorie");

        this.init(Resources.getGlobalResources());
        TextField nomField = new TextField("", "Nom");
        TextField slugField = new TextField("", "Descriptif");

        this.add(nomField);

        this.add(slugField);

        Button submitButton = new Button("Submit");

        submitButton.addActionListener(s
                -> {
            String nom = nomField.getText();
            String slug = slugField.getText();

            Categorie newCat = new Categorie();
            newCat.setName(nom);
            newCat.setType(slug);
            CategorieWebService service = new CategorieWebService();
            service.newCategorie(newCat);
        }
        );
        this.add(submitButton);
        Button goToFormButton = new Button("Go Back");
        goToFormButton.addActionListener(e -> {
            getCategorieForm myForm = new getCategorieForm();
            myForm.show();
        });
        this.add(goToFormButton);
    }

}
