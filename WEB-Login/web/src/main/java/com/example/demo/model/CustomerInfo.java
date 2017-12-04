package com.example.demo.model;

import com.example.demo.entity.Accounts;

public class CustomerInfo {

	private String name;
	private String address;
	private String email;
	private String phone;

	private boolean valid;

	public CustomerInfo() {
		this.name = "";
		this.address = "";
		this.email = "";
		this.phone = "";
	}
	
	public CustomerInfo(Accounts account) {
		this.name = account.getFirstName() + " " + account.getLastName();
		this.address = account.getAddress();
		this.email = account.getEmail();
		this.phone = account.getPhone();
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

}