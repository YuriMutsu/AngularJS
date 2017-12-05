package com.example.demo.controller;

import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.model.CartInfo;
import com.example.demo.utils.Utils;

@Controller
public class MainController {

	private Logger m_logger = Logger.getLogger(MainController.class);
	
	@RequestMapping("/403")
	public String error403() {
		return "/error/403";
	}

	@RequestMapping({"/", "/home"})
	public String home(HttpServletRequest request) {
		Utils.getNumberProductOfCart(request);
		Utils.getCartInSession(request);
		return "index";
	}

	@RequestMapping("/pagination")
	public String pagination() {
		return "pagination";
	}
	
	@RequestMapping("/news")
	public String news() {
		return "news";
	}
	
	@RequestMapping("/pay")
	public String pay(HttpServletRequest request, @RequestParam("user") String username) {
		CartInfo cartInfo = Utils.getCartInSession(request);
		if (username == null || username == ""){
			return "redirect:/403";
		}
		
		if (cartInfo != null){
			m_logger.info("CUSTOMER INFO: " + cartInfo.getCustomerInfo().getUsername());
			System.out.println("CUSTOMER INFO: " + cartInfo.getCustomerInfo().getUsername());
			if (username.equals(cartInfo.getCustomerInfo().getUsername())){
				return "pay";
			}else{
				return "redirect:/cart";
			}
		}else{
			return "redirect:/cart";
		}
	}
	
	// GET: Show Login Page
	// GET: Hiển thị trang login
	@RequestMapping(value = { "/login" }, method = RequestMethod.GET)
	public String login() {
		return "login";
	}
}
