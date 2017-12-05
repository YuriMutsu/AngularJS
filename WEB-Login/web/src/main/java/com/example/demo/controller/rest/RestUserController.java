package com.example.demo.controller.rest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.Accounts;
import com.example.demo.model.CustomerInfo;
import com.example.demo.service.AccountService;

@RestController
@RequestMapping("/rest")
public class RestUserController {

	@Autowired
	private AccountService accountService;
	
	@GetMapping("/users")
	public ResponseEntity<CustomerInfo> getCustomerInfo(@RequestParam("user") String username){
		Accounts account = accountService.findAccount(username);
		if (account != null){
			CustomerInfo customerInfo = new CustomerInfo(account);
			return new ResponseEntity<CustomerInfo>(customerInfo, HttpStatus.OK);
		}else{
			return new ResponseEntity<CustomerInfo>(new CustomerInfo(), HttpStatus.OK);
		}
	}
}
