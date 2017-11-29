package com.example.demo.service;

import com.example.demo.entity.Accounts;

public interface AccountService {
	public Accounts findAccount(String userName);
	
	public void save(Accounts account);
}
