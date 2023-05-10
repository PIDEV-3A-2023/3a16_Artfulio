/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.entities;

/**
 *
 * @author Andrew
 */
public class Reclamation {
    private int idRec;
    private String Titre, ReclamationSec, email;

    public Reclamation() {
    }

    
    
    public Reclamation(int idRec, String Titre, String ReclamationSec, String email) {
        this.idRec = idRec;
        this.Titre = Titre;
        this.ReclamationSec = ReclamationSec;
        this.email = email;
    }

    public Reclamation(String Titre, String ReclamationSec, String email) {
        this.Titre = Titre;
        this.ReclamationSec = ReclamationSec;
        this.email = email;
    }

    public int getIdRec() {
        return idRec;
    }

    public void setIdRec(int idRec) {
        this.idRec = idRec;
    }

    public String getTitre() {
        return Titre;
    }

    public void setTitre(String Titre) {
        this.Titre = Titre;
    }

    public String getReclamationSec() {
        return ReclamationSec;
    }

    public void setReclamationSec(String ReclamationSec) {
        this.ReclamationSec = ReclamationSec;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    @Override
    public String toString() {
        return "Task{" + "idRec=" + idRec + ", Titre=" + Titre + ", ReclamationSec=" + ReclamationSec + ", email=" + email + '}';
    }

    
    
    
    
    
}
