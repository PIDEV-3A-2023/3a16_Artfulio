package com.mycompany.GUI;

import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.FontImage;
import com.codename1.ui.list.MultiList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.list.DefaultListModel;
import com.codename1.ui.util.Resources;
import java.util.Collections;
import java.util.Comparator;

import com.mycompany.entities.Categorie;
import com.mycompany.services.CategorieWebService;
import com.codename1.ui.Form;
import com.codename1.ui.Toolbar;

public class getCategorieForm extends Form {

    private MultiList eventList;
    private List<Categorie> cats;

    public getCategorieForm() {
      //  this.init(Resources.getGlobalResources());
        eventList = new MultiList(new DefaultListModel<>());
        add(eventList);

        getAllCats();

        Button sortButton = new Button("Sort by Name");
        sortButton.addActionListener(e -> {
            Collections.sort(cats, new Comparator<Categorie>() {
                @Override
                public int compare(Categorie c1, Categorie c2) {
                    return c1.getName().compareToIgnoreCase(c2.getName());
                }
            });
            updateList();
        });
        addComponent(BorderLayout.south(sortButton));
           //    getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());
    getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> new MenuCat(this).showBack());

    }

    private void getAllCats() {
        CategorieWebService service = new CategorieWebService();
        cats = service.getAllCategorie();
        updateList();

        eventList.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    Map<String, Object> selectedItem = (Map<String, Object>) eventList.getSelectedItem();
                    int catId = (int) selectedItem.get("Line3");
                    Categorie selectedEvent = null;
                    for (Categorie c : cats) {
                        if (c.getId() == catId) {
                            selectedEvent = c;
                            break;
                        }
                    }
                    editFormCategorie myForm2 = new editFormCategorie(selectedEvent);
                    myForm2.show();
                } catch (ParseException ex) {
                    System.out.println(ex);
                }
            }
        });
    }

    private void updateList() {
        DefaultListModel<Map<String, Object>> model = (DefaultListModel<Map<String, Object>>) eventList.getModel();
        model.removeAll();
        for (Categorie c : cats) {
            Map<String, Object> item = new HashMap<>();
            item.put("Line1", "Nom : " + c.getName());
            item.put("Line2", "Type : " + c.getType());
            item.put("Line3", c.getId());
            model.addItem(item);
        }
    }
}
