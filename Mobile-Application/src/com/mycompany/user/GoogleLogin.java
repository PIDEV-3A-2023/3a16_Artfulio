/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.user;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import com.codename1.ui.BrowserComponent;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.layouts.BorderLayout;

/**
 *
 * @author user
 */
public class GoogleLogin extends Form{

    public GoogleLogin() {
    Container container = new Container(new BorderLayout());
BrowserComponent browser = new BrowserComponent();
browser.setURL("https://www.google.com");
add(BorderLayout.CENTER, container);

// Set the preferred size of the container to the size of the main form
container.setPreferredW(this.getWidth());
container.setPreferredH(this.getHeight());



container.add(BorderLayout.CENTER, browser);






       
        
    }
    
}
