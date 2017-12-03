package com.example.demo.service;

import com.example.demo.entity.Accounts;
import com.example.demo.model.CustomerInfo;

public interface AccountService {
	public Accounts findAccount(String userName);
	
	public void save(Accounts account);
	
	public boolean isExist(String username);
	
	public CustomerInfo getCustomer(String userName);
}
