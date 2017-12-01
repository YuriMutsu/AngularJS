package com.example.demo.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.Accounts;
import com.example.demo.reponsitory.AccountRepository;
import com.example.demo.service.AccountService;

@Service
public class AccountServiceImpl implements AccountService{

	@Autowired
	private AccountRepository accountRepository;
	
	@Override
	public Accounts findAccount(String userName) {
		List<Accounts> listAccount = (List<Accounts>) accountRepository.findAll();
		for (Accounts account : listAccount){
			if (account.getUserName().equals(userName)){
				return account;
			}
		}
		return null;
	}

	@Override
	public void save(Accounts account) {
		accountRepository.save(account);
	}

	@Override
	public boolean isExist(String username) {
		Accounts account = findAccount(username);
		if (account != null){
			return true;
		}
		return false;
	}

}
