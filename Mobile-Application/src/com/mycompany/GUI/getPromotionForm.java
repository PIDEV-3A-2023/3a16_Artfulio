package com.mycompany.GUI;

import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.TextField;
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
import com.mycompany.entities.Promotion;
import com.mycompany.myapp.Home;

import com.mycompany.services.PromotionWebService;

public class getPromotionForm extends BaseForm {

    private MultiList eventList;
    private List<Promotion> promos;
    private TextField searchField;

    public getPromotionForm() {
        this.init(Resources.getGlobalResources());
        eventList = new MultiList(new DefaultListModel<>());
        add(eventList);

        getAllPromos();

        Button sortButton = new Button("Sort by Type");
        sortButton.addActionListener(e -> {
            Collections.sort(promos, new Comparator<Promotion>() {
                @Override
                public int compare(Promotion p1, Promotion p2) {
                    return p1.getType().compareToIgnoreCase(p2.getType());
                }
            });
            updateList();
        });
        addComponent(BorderLayout.south(sortButton));
            getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, e -> new MenuPromo(this).showBack());

    }

    private void getAllPromos() {
        PromotionWebService service = new PromotionWebService();
        promos = service.getAllPromotions();
        updateList();

        eventList.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    Map<String, Object> selectedItem = (Map<String, Object>) eventList.getSelectedItem();
                    int promoId = (int) selectedItem.get("Line3");
                    Promotion selectedPromo = null;
                    for (Promotion p : promos) {
                        if (p.getId() == promoId) {
                            selectedPromo = p;
                            break;
                        }
                    }
                    editFormPromotion myForm2 = new editFormPromotion(selectedPromo);
                    myForm2.show();
                } catch (ParseException ex) {
                    System.out.println(ex);
                }
            }
        });
        
        searchField = new TextField("", "Enter Promotion Type");
        Button searchButton = new Button("Search");
        searchButton.addActionListener(e -> {
            try {
                String searchId = searchField.getText();
                Promotion selectedPromo = null;
                for (Promotion p : promos) {
                    if (p.getType() == null ? searchId == null : p.getType().equals(searchId)) {
                        selectedPromo = p;
                        break;
                    }
                }
                if (selectedPromo != null) {
                    editFormPromotion myForm2 = new editFormPromotion(selectedPromo);
                    myForm2.show();
                } else {
                    Dialog.show("Error", "Promotion not found", "OK", null);
                }
            } catch (NumberFormatException ex) {
                Dialog.show("Error", "Invalid ID", "OK", null);
            } catch (ParseException ex) {
                System.out.println(ex);
            }
        });
        Container searchContainer = BorderLayout.west(searchField).add(BorderLayout.EAST, searchButton);
        addComponent(searchContainer);
    }

    private void updateList() {
        DefaultListModel<Map<String, Object>> model = (DefaultListModel<Map<String, Object>>) eventList.getModel();
        model.removeAll();
        for (Promotion p : promos) {
            Map<String, Object> item = new HashMap<>();
            item.put("Line1", "Remise : " + p.getRemise());
            item.put("Line2", "Type : " + p.getType());
            item.put("Line3", p.getId());
            model.addItem(item);
        }
    }
}
