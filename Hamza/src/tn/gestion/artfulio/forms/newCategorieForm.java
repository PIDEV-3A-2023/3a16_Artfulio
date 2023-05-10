package tn.gestion.artfulio.forms;

import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import tn.gestion.artfulio.entites.Categorie;
import tn.gestion.promotion.service.CategorieWebService;

public class newCategorieForm extends BaseForm {

    public newCategorieForm() {
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

            Categorie newCategorie = new Categorie();
            newCategorie.setName(nom);
            newCategorie.setType(slug);
            CategorieWebService service = new CategorieWebService();
            service.newCategorie(newCategorie);
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
