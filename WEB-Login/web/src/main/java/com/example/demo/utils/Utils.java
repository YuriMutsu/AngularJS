package com.example.demo.utils;

import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;

import com.example.demo.model.CartInfo;
import com.example.demo.model.CustomerInfo;

public class Utils {
	
	private static Logger m_logger = Logger.getLogger(Utils.class);
	
	// Thông tin các mặt hàng đã mua, được lưu trữ trong Session.
	public static CartInfo getCartInSession(HttpServletRequest request) {

		// Thông tin giỏ hàng có thể đã lưu vào trong Session trước đó.
		CartInfo cartInfo = (CartInfo) request.getSession().getAttribute("myCart");

		// Nếu chưa tạo giỏ hàng, tạo nó.
		if (cartInfo == null) {
			cartInfo = new CartInfo();
			
			if (!SecurityContextHolder.getContext().getAuthentication().getPrincipal().getClass().equals(String.class)){
				UserDetails userDetails = (UserDetails) SecurityContextHolder.getContext().getAuthentication().getPrincipal();
				CustomerInfo customerInfo = new CustomerInfo();
				customerInfo.setName(userDetails.getUsername());
				cartInfo.setCustomerInfo(customerInfo);
			}
			// Và lưu vào trong session.
			request.getSession().setAttribute("myCart", cartInfo);
		}
		return cartInfo;
	}

	public static void setCartInSession(HttpServletRequest request, CartInfo cartInfo) {
		request.getSession().setAttribute("myCart", cartInfo);
	}
	
	public static void removeCartInSession(HttpServletRequest request) {
		request.getSession().removeAttribute("myCart");
	}

	public static void storeLastOrderedCartInSession(HttpServletRequest request, CartInfo cartInfo) {
		request.getSession().setAttribute("lastOrderedCart", cartInfo);
	}

	public static CartInfo getLastOrderedCartInSession(HttpServletRequest request) {
		return (CartInfo) request.getSession().getAttribute("lastOrderedCart");
	}

	public static int getNumberProductOfCart(HttpServletRequest request) {
		int numProduct = 0;
		if (request.getSession().getAttribute("numProduct") == null) {
			request.getSession().setAttribute("numProduct", numProduct);
		}else {
			numProduct = (int) request.getSession().getAttribute("numProduct");
		}
		return numProduct;
	}
	
	public static void updateNumberProductOfCart(HttpServletRequest request) {
		int numProduct = getNumberProductOfCart(request);
		request.getSession().setAttribute("numProduct", numProduct + 1);
	}
	
	public static void updateAddNumberProductOfCart(HttpServletRequest request, int number) {
		request.getSession().setAttribute("numProduct", number);
	}
}
