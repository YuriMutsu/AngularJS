package com.example.demo.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Propagation;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import com.example.demo.entity.Accounts;
import com.example.demo.entity.ProductFavorite;
import com.example.demo.model.CustomerInfo;
import com.example.demo.model.OrderDetailInfo;
import com.example.demo.model.OrderInfo;
import com.example.demo.model.ProductInfo;
import com.example.demo.service.AccountService;
import com.example.demo.service.OrderService;
import com.example.demo.service.ProductFavoriteService;
import com.example.demo.service.ProductService;

@Controller
public class AdminController {

	@Autowired
	private OrderService orderDAO;

	@Autowired
	private ProductService productDAO;
	
	@Autowired
	private AccountService accoutService;

	@Autowired
	private ProductFavoriteService productFavoriteService;
	
	@RequestMapping(value = {"/accountInfo"}, method = RequestMethod.GET)
	public String accountInfo(Model model) {
		if (SecurityContextHolder.getContext().getAuthentication().getPrincipal().getClass().equals(String.class)){
			return "redirect:/403";
		}
		UserDetails userDetails = (UserDetails) SecurityContextHolder.getContext().getAuthentication().getPrincipal();
		CustomerInfo customerInfo = accoutService.getCustomer(userDetails.getUsername());
		model.addAttribute("customerInfo", customerInfo);
		
		List<ProductFavorite> listProductFavorites = productFavoriteService.findByUsername(userDetails.getUsername());
		model.addAttribute("listProductFavorites", listProductFavorites);
		
		return "accountInfo";
	}

//	@RequestMapping(value = { "/orderList" }, method = RequestMethod.GET)
//	public String orderList(Model model, //
//			@RequestParam(value = "page", defaultValue = "1") String pageStr) {
//		int page = 1;
//		try {
//			page = Integer.parseInt(pageStr);
//		} catch (Exception e) {
//		}
//		final int MAX_RESULT = 5;
//		final int MAX_NAVIGATION_PAGE = 10;
//
//		PaginationResult<OrderInfo> paginationResult //
//				= orderDAO.listOrderInfo(page, MAX_RESULT, MAX_NAVIGATION_PAGE);
//
//		model.addAttribute("paginationResult", paginationResult);
//		return "orderList";
//	}

	// GET: Show product.
	// GET: Hiển thị product
	@RequestMapping(value = { "/product" }, method = RequestMethod.GET)
	public String product(Model model, @RequestParam(value = "code", defaultValue = "") String code) {
		ProductInfo productInfo = null;

		if (code != null && code.length() > 0) {
			productInfo = productDAO.findProductInfo(code);
		}
		if (productInfo == null) {
			productInfo = new ProductInfo();
			productInfo.setNewProduct(true);
		}
		model.addAttribute("productForm", productInfo);
		return "product";
	}

	// POST: Save product
	@RequestMapping(value = { "/product" }, method = RequestMethod.POST)
	// Avoid UnexpectedRollbackException (See more explanations)
	// Tránh ngoại lệ: UnexpectedRollbackException (Xem giải thích thêm).
	@Transactional(propagation = Propagation.NEVER)
	public String productSave(Model model, //
			@ModelAttribute("productForm") @Validated ProductInfo productInfo, //
			BindingResult result, //
			final RedirectAttributes redirectAttributes) {

		if (result.hasErrors()) {
			return "product";
		}
		try {
			productDAO.save(productInfo);
		} catch (Exception e) {
			// Need: Propagation.NEVER?
			// Cần thiết: Propagation.NEVER?
			String message = e.getMessage();
			model.addAttribute("message", message);
			// Show product form.
			return "product";

		}
		return "redirect:/productList";
	}

	@RequestMapping(value = { "/order" }, method = RequestMethod.GET)
	public String orderView(Model model, @RequestParam("orderId") String orderId) {
		OrderInfo orderInfo = null;
		if (orderId != null) {
			orderInfo = this.orderDAO.getOrderInfo(orderId);
		}
		if (orderInfo == null) {
			return "redirect:/orderList";
		}
		List<OrderDetailInfo> details = this.orderDAO.listOrderDetailInfos(orderId);
		orderInfo.setDetails(details);

		model.addAttribute("orderInfo", orderInfo);

		return "order";
	}

}
