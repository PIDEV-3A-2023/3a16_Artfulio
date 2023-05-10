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
import com.codename1.ui.FontImage;
import com.codename1.ui.list.MultiList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.list.DefaultListModel;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Store;
import com.mycompany.services.ServiceStore;


public class getStoreForm extends BaseForm {

    private MultiList eventList;

    public getStoreForm() {
        this.init(Resources.getGlobalResources());
        eventList = new MultiList(new DefaultListModel<>());
        add(eventList);
        getStores();
    }

    private void getStores() {
        ServiceStore service = new ServiceStore();
        List<Store> stores = service.affichageStore();
        DefaultListModel<Map<String, Object>> model = (DefaultListModel<Map<String, Object>>) eventList.getModel();
        model.removeAll();
            getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> new MenuStore(this).showBack());

        for (Store s : stores) {
            Map<String, Object> item = new HashMap<>();
            item.put("Line1", "Nom : " + s.getNom_artwork());
            item.put("Line2", "img : " + s.getImg_artwork());
            item.put("Line3", "prix : " + s.getPrix_artwork());
            item.put("Line4", "id_piece_art : " + s.getId_piece_art());
            item.put("Line5", s.getId_produit());
            model.addItem(item);
        }
        eventList.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    Map<String, Object> selectedItem = (Map<String, Object>) eventList.getSelectedItem();
                    int stId = (int) selectedItem.get("Line5");
                    Store selectedEvent = null;
                    for (Store s : stores) {
                        if (s.getId_produit()== stId) {
                            selectedEvent = s;
                            break;
                        }
                    }
                    editFormStore myForm2 = new editFormStore(selectedEvent);
                    myForm2.show();
                    System.out.println(myForm2);
                } catch (ParseException ex) {
                    System.out.println(ex);
                }
            }
        });

    }
}

