/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.entities;

/**
 *
 * @author user
 */
public class Utilisateur {

    private int id;
    private String username;
    private String cin_user;
    private String email;
    private String password;
    private String img_user;
    private String adresse_user;
    private String roles;
    private boolean is_pro;

    public Utilisateur() {
    }

    public Utilisateur(int id, String username, String cin_user, String email, String password, String img_user, String adresse_user, String roles, boolean is_pro) {
        this.id = id;
        this.username = username;
        this.cin_user = cin_user;
        this.email = email;
        this.password = password;
        this.img_user = img_user;
        this.adresse_user = adresse_user;
        this.roles = roles;
        this.is_pro = is_pro;
    }

    public Utilisateur(String username, String cin_user, String email, String password, String img_user, String adresse_user, String roles, boolean is_pro) {
        this.username = username;
        this.cin_user = cin_user;
        this.email = email;
        this.password = password;
        this.img_user = img_user;
        this.adresse_user = adresse_user;
        this.roles = roles;
        this.is_pro = is_pro;
    }

    public Utilisateur(String username, String cin_user, String email, String password, String adresse_user, String roles) {
        this.username = username;
        this.cin_user = cin_user;
        this.email = email;
        this.password = password;
        this.adresse_user = adresse_user;
        this.roles = roles;
    }

   

    public boolean isIs_pro() {
        return is_pro;
    }

    public void setIs_pro(boolean is_pro) {
        this.is_pro = is_pro;
    }

   
    public int getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public String getCin_user() {
        return cin_user;
    }

    public String getEmail() {
        return email;
    }

    public String getPassword() {
        return password;
    }

    public String getImg_user() {
        return img_user;
    }

    public String getAdresse_user() {
        return adresse_user;
    }

    public String getRoles() {
        return roles;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public void setCin_user(String cin_user) {
        this.cin_user = cin_user;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setImg_user(String img_user) {
        this.img_user = img_user;
    }

    public void setAdresse_user(String adresse_user) {
        this.adresse_user = adresse_user;
    }

    public void setRoles(String roles) {
        this.roles = roles;
    }

    @Override
    public String toString() {
        return "Utilisateur{" + "id=" + id + ", username=" + username + ", cin_user=" + cin_user + ", email=" + email + ", password=" + password + ", img_user=" + img_user + ", adresse_user=" + adresse_user + ", roles=" + roles + ", is_pro=" + is_pro + '}';
    }

    

}
