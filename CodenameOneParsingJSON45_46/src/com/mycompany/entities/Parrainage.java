/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.entities;

/**
 *
 * @author 21652
 */
public class Parrainage {
    
    
    private int idParrainage, idUser;

    public Parrainage() {
    }

    
    
    public Parrainage(int idParrainage, int idUser, String email) {
        this.idParrainage = idParrainage;
        this.idUser = idUser;
    }

    public int getIdParrainage() {
        return idParrainage;
    }
    

    public void setIdParrainage(int idParrainage) {
        this.idParrainage = idParrainage;
    }

    public int getIdUser() {
        return idUser;
    }

    public void setIdUser(int idUser) {
        this.idUser = idUser;
    }

    

    @Override
    public String toString() {
        return "Parrainage{" + "idParrainage=" + idParrainage + ", idUser=" + idUser  + '}';
    }
    
    
}
