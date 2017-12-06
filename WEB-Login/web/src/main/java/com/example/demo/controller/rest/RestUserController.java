package com.example.demo.controller.rest;

import java.io.IOException;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.Accounts;
import com.example.demo.entity.Products;
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
	
	@RequestMapping(value = { "/avatar" }, method = RequestMethod.GET)
	public void productImage(HttpServletRequest request, HttpServletResponse response, Model model,
			@RequestParam("user") String username) throws IOException {
		Accounts account = null;
		if (username != null) {
			account = accountService.findAccount(username);
		}
		if (account != null && account.getAvatar() != null) {
			response.setContentType("image/jpeg, image/jpg, image/png, image/gif");
			response.getOutputStream().write(account.getAvatar());
		}
		response.getOutputStream().close();
	}
}
