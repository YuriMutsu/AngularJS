package com.example.demo.service.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.Account;
import com.example.demo.reponsitory.AccountRepository;
import com.example.demo.service.AccountService;

@Service
public class AccountServiceImpl implements AccountService{

	@Autowired
	private AccountRepository accountRepository;
	
	@Override
	public Account findAccount(String userName) {
		List<Account> listAccount = (List<Account>) accountRepository.findAll();
		for (Account account : listAccount){
			if (account.getUserName().equals(userName)){
				return account;
			}
		}
		return null;
	}

	@Override
	public void save(Account account) {
		accountRepository.save(account);
	}

}
