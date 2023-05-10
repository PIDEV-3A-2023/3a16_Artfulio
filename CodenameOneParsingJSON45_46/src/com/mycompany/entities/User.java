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
public class User {

    private int idUser, isPro = 0;
    private String username, cinUser, adresseUser, passwordUser, emailUser, imgUser, typeRole;

    public User(int idUser) {
        this.idUser = idUser;
    }

    public User() {
    }

    public int getIdUser() {
        return idUser;
    }

    public void setIdUser(int idUser) {
        this.idUser = idUser;
    }

    public int getIsPro() {
        return isPro;
    }

    public void setIsPro(int isPro) {
        this.isPro = isPro;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getCinUser() {
        return cinUser;
    }

    public void setCinUser(String cinUser) {
        this.cinUser = cinUser;
    }

    public String getAdresseUser() {
        return adresseUser;
    }

    public void setAdresseUser(String adresseUser) {
        this.adresseUser = adresseUser;
    }

    public String getPasswordUser() {
        return passwordUser;
    }

    public void setPasswordUser(String passwordUser) {
        this.passwordUser = passwordUser;
    }

    public String getEmailUser() {
        return emailUser;
    }

    public void setEmailUser(String emailUser) {
        this.emailUser = emailUser;
    }

    public String getImgUser() {
        return imgUser;
    }

    public void setImgUser(String imgUser) {
        this.imgUser = imgUser;
    }

    public String getTypeRole() {
        return typeRole;
    }

    public void setTypeRole(String typeRole) {
        this.typeRole = typeRole;
    }

    @Override
    public String toString() {
        return "User{" + "idUser=" + idUser + ", isPro=" + isPro + ", username=" + username + ", cinUser=" + cinUser + ", adresseUser=" + adresseUser + ", passwordUser=" + passwordUser + ", emailUser=" + emailUser + ", imgUser=" + imgUser + ", typeRole=" + typeRole + '}';
    }

    
    
}
