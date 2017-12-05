package com.example.demo.controller;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.contants.UserConstant;
import com.example.demo.entity.Accounts;
import com.example.demo.service.AccountService;

@Controller
public class UserController {

	private Logger m_logger = Logger.getLogger(UserController.class);
	@Autowired
	private AccountService accountService;

	@Autowired
	private PasswordEncoder passwordEncoder;

	@RequestMapping("/register")
	public String register(Model model) {
		return "register";
	}

	@RequestMapping(value = "/doRegister", method = RequestMethod.POST, consumes = MediaType.APPLICATION_FORM_URLENCODED_VALUE, produces = MediaType.APPLICATION_JSON_VALUE)
	public String doRegister(Model model, @RequestParam("firstName") String firstName,
			@RequestParam("lastName") String lastName, @RequestParam("username") String username,
			@RequestParam("password") String password, @RequestParam("retypepassword") String retypepassword,
			@RequestParam("address") String address, @RequestParam("email") String email,
			@RequestParam("phone") String phone, @RequestParam("birthday") String birthday,
			@RequestParam("gender") String gender) {
		
		Accounts account = new Accounts();
		m_logger.info("Account : " + username);
		account.setUserName(username);
		
		if (password.equals(retypepassword)){
			account.setPassword(passwordEncoder.encode(password));
		}else{
			m_logger.info("Mật khẩu xác nhận chưa chính xác !");
			return "redirect:/register?error";
		}
		
		if (!accountService.isExist(account.getUserName())) {
			account.setAddress(address);
			account.setBirthday(birthday);
			account.setEmail(email);
			account.setFirstName(firstName);
			account.setLastName(lastName);
			account.setGender(gender);
			account.setPhone(phone);
			account.setUserRole(UserConstant.ROLE_MEMBER);
			account.setActive(true);
			accountService.save(account);
			m_logger.info("Save Account Success");
			model.addAttribute("success", "register Success");
			return "redirect:/login";
		} else {
			m_logger.info("Save Account ERROR. Account is exist !! ");
			return "redirect:/register?error";
		}
	}

	@RequestMapping("/changePassword")
	public String changePassword() {
		return "changePassword";
	}
}
