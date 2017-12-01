package com.example.demo.controller;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

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
			account.setActive(true);
			accountService.save(account);
			m_logger.info("Save Account Success");
			model.addAttribute("success", "register Success");
			return "redirect:/";
		} else {
			m_logger.info("Save Account ERROR. Account is exist !! ");
			return "redirect:/register?error";
		}

		/*
		 * m_logger.info("Account : " + account);
		 * account.setPassword(passwordEncoder.encode(account.getPassword()));
		 * if (!accountService.isExist(account.getUserName())){
		 * account.setActive(true); accountService.save(account);
		 * m_logger.info("Save Account Success"); model.addAttribute("success",
		 * "register Success"); return "redirect:/"; }else{
		 * m_logger.info("Save Account ERROR. Account is exist !! "); return
		 * "redirect:/register"; }
		 */
	}

	@PostMapping("/doRegister2")
	public String doRegisterClient() {
		return "redirect:/";
	}

	// GET: Show Login Page
	// GET: Hiển thị trang login
	@RequestMapping(value = { "/login" }, method = RequestMethod.GET)
	public String login() {
		return "login";
	}

	@RequestMapping("/changePassword")
	public String changePassword() {
		return "changePassword";
	}

}
