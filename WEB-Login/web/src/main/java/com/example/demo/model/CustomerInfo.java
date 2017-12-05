package com.example.demo.model;

import com.example.demo.entity.Accounts;

public class CustomerInfo {
	private String username;
	private String firstName;
	private String lastName;
	private String name;
	private String address;
	private String birthday;
	private String email;
	private String phone;
	private boolean checkGender;
	
	private boolean valid;

	public CustomerInfo() {
		this.name = "";
		this.address = "";
		this.email = "";
		this.phone = "";
	}
	
	public CustomerInfo(Accounts account) {
		this.username = account.getUserName();
		this.firstName = account.getFirstName();
		this.lastName = account.getLastName();
		this.name = this.firstName + " " + this.lastName;
		this.address = account.getAddress();
		this.birthday = account.getBirthday();
		this.email = account.getEmail();
		this.phone = account.getPhone();
		if (account.getGender().equalsIgnoreCase("Nam")){
			this.checkGender = true;
		}else{
			this.checkGender = false;
		}
	}
	
	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getAddress() {
		return address;
	}

	public void setAddress(String address) {
		this.address = address;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}

	public boolean isValid() {
		return valid;
	}

	public void setValid(boolean valid) {
		this.valid = valid;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getBirthday() {
		return birthday;
	}

	public void setBirthday(String birthday) {
		this.birthday = birthday;
	}

	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getLastName() {
		return lastName;
	}

	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	public boolean isCheckGender() {
		return checkGender;
	}

	public void setCheckGender(boolean checkGender) {
		this.checkGender = checkGender;
	}
}