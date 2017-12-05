package com.example.demo.controller;
import javax.servlet.http.HttpServletRequest;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Propagation;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import com.example.demo.entity.Accounts;
import com.example.demo.model.CartInfo;
import com.example.demo.model.CartLineInfo;
import com.example.demo.model.CustomerInfo;
import com.example.demo.model.ProductDetailInfo;
import com.example.demo.model.ProductInfo;
import com.example.demo.service.AccountService;
import com.example.demo.service.OrderService;
import com.example.demo.service.ProductDetailService;
import com.example.demo.utils.Utils;

@Controller
public class CartController {
	
	private Logger m_logger = Logger.getLogger(CartController.class);
	
	@Autowired
	private OrderService orderService;

	@Autowired
	private ProductDetailService productDetailService;
	
	@Autowired
	private AccountService accountService;
	
	private CustomerInfo getCustomerInfo(){
		UserDetails userDetails = (UserDetails) SecurityContextHolder.getContext().getAuthentication().getPrincipal();
		Accounts account = accountService.findAccount(userDetails.getUsername());
		CustomerInfo customerInfo = new CustomerInfo(account);
		return customerInfo;
	}
	
	// GET: Hiển thị giỏ hàng.
	@RequestMapping(value = { "/cart" }, method = RequestMethod.GET)
	public String cart(HttpServletRequest request, Model model) {
		CartInfo myCart = Utils.getCartInSession(request);

		model.addAttribute("cartForm", myCart);
		return "cart";
	}
	
	// GET: Hiển thị giỏ hàng.
	@RequestMapping(value = { "/shoppingCart" }, method = RequestMethod.GET)
	public String cartShow(HttpServletRequest request, Model model) {
		CartInfo myCart = Utils.getCartInSession(request);

		model.addAttribute("cartForm", myCart);
		return "shoppingCart";
	}
	
	@SuppressWarnings("deprecation")
	@PostMapping("/addToCart")
	public ResponseEntity<Void> addToCartPost(HttpServletRequest request, Model model, @RequestBody ProductDetailInfo productDetailInfo) {
		
		if (SecurityContextHolder.getContext().getAuthentication().getPrincipal().getClass().equals(String.class)){
			m_logger.info("You does not login !");
			return new ResponseEntity<Void>(HttpStatus.METHOD_FAILURE);
		}
		
		CustomerInfo customerInfo = getCustomerInfo();
		
		ProductInfo productInfo = new ProductInfo(productDetailInfo);
		
		CartInfo cartInfo = Utils.getCartInSession(request);
		
		cartInfo.setCustomerInfo(customerInfo);
		
		if (cartInfo.isEmpty()) {
			cartInfo.addProduct(productInfo);
		}else {
			if (cartInfo.isExitsProduct(productDetailInfo.getCode())) {
				m_logger.info("Quantity of Product from DB in SERVER: " + productDetailInfo.getQuantity());
				CartLineInfo cartLine = cartInfo.findLineByCode(productDetailInfo.getCode());
				
				m_logger.info("Quantity of Product from Cart: " + cartLine.getQuantity());
				if (cartLine.getQuantity() < productDetailInfo.getQuantity()){
					cartInfo.updateProduct(productDetailInfo.getCode());
				}else{
					return new ResponseEntity<Void>(HttpStatus.LENGTH_REQUIRED);
				}
			}else {
				cartInfo.addProduct(productInfo);
			}
		}
		Utils.updateNumberProductOfCart(request);
		Utils.setCartInSession(request, cartInfo);
		return new ResponseEntity<Void>(HttpStatus.OK);
	}
	
	@PostMapping("/updateCart")
	public String updateCartPost(HttpServletRequest request, @RequestParam("code") String code, @RequestParam("quantity") int quantity) {
		
		if (SecurityContextHolder.getContext().getAuthentication().getPrincipal().getClass().equals(String.class)){
			m_logger.info("You does not login !");
			return "/login";
		}
		
		CustomerInfo customerInfo = getCustomerInfo();
		
		ProductDetailInfo productDetailInfo = productDetailService.findProductDetailInfo(code);
		
		CartInfo cartInfo = Utils.getCartInSession(request);
		
		cartInfo.setCustomerInfo(customerInfo);
		
		CartLineInfo cartLine = cartInfo.findLineByCode(productDetailInfo.getCode());
		
		int numProduct = Utils.getNumberProductOfCart(request);
		
		if (quantity > cartLine.getMaxNumberOfProduct()){
			Utils.updateAddNumberProductOfCart(request, cartLine.getMaxNumberOfProduct());
		}else{
			if (quantity > cartLine.getQuantity()){
				int less = quantity - cartLine.getQuantity();
				Utils.updateAddNumberProductOfCart(request, numProduct + less);
			}else{
				int less = cartLine.getQuantity() - quantity;
				Utils.updateAddNumberProductOfCart(request, numProduct - less);
			}
		}
		
		cartInfo.updateProduct(code, quantity);
		Utils.setCartInSession(request, cartInfo);
		
		return "redirect:/cart";
	}
	
	@GetMapping("/removeFromCart")
	public String removeFromCart(HttpServletRequest request, @RequestParam("code") String code){
		ProductDetailInfo productDetailInfo = productDetailService.findProductDetailInfo(code);
		
		CartInfo cartInfo = Utils.getCartInSession(request);
		
		CartLineInfo cartLine = cartInfo.findLineByCode(productDetailInfo.getCode());
		
		int numProduct = Utils.getNumberProductOfCart(request);
		
		int less = numProduct - cartLine.getQuantity();
		
		Utils.updateAddNumberProductOfCart(request, less);
		
		cartInfo.updateProduct(code, 0);
		
		Utils.setCartInSession(request, cartInfo);
		
		return "redirect:/cart";
	}
	
	// POST: Cập nhập số lượng cho các sản phẩm đã mua.
	@RequestMapping(value = { "/shoppingCart" }, method = RequestMethod.POST)
	public String shoppingCartUpdateQty(HttpServletRequest request, Model model, @ModelAttribute("cartForm") CartInfo cartForm) {

		CartInfo cartInfo = Utils.getCartInSession(request);
		cartInfo.updateQuantity(cartForm);

		// Chuyển sang trang danh sách các sản phẩm đã mua.
		return "redirect:/shoppingCart";
	}
		
	/*@RequestMapping({ "/shoppingCartRemoveProduct" })
	public String removeProductHandler(HttpServletRequest request, Model model, //
			@RequestParam(value = "code", defaultValue = "") String code) {
		Products product = null;
		if (code != null && code.length() > 0) {
			product = productService.findProduct(code);
		}
		if (product != null) {

			// Thông tin giỏ hàng có thể đã lưu vào trong Session trước đó.
			CartInfo cartInfo = Utils.getCartInSession(request);

			ProductInfo productInfo = new ProductInfo(product);

			cartInfo.removeProduct(productInfo);

		}

		// Chuyển sang trang danh sách các sản phẩm đã mua.
		return "redirect:/shoppingCart";
	}*/

	// GET: Nhập thông tin khách hàng.
	@RequestMapping(value = { "/shoppingCartCustomer" }, method = RequestMethod.GET)
	public String shoppingCartCustomerForm(HttpServletRequest request, Model model) {

		CartInfo cartInfo = Utils.getCartInSession(request);

		// Chưa mua mặt hàng nào.
		if (cartInfo.isEmpty()) {

			// Chuyển tới trang danh giỏ hàng
			return "redirect:/shoppingCart";
		}

		CustomerInfo customerInfo = cartInfo.getCustomerInfo();
		if (customerInfo == null) {
			customerInfo = new CustomerInfo();
		}

		model.addAttribute("customerForm", customerInfo);

		return "shoppingCartCustomer";
	}

	// POST: Save thông tin khách hàng.
	@RequestMapping(value = { "/shoppingCartCustomer" }, method = RequestMethod.POST)
	public String shoppingCartCustomerSave(HttpServletRequest request, //
			Model model, //
			@ModelAttribute("customerForm") @Validated CustomerInfo customerForm, //
			BindingResult result, //
			final RedirectAttributes redirectAttributes) {

		// Kết quả Validate CustomerInfo.
		if (result.hasErrors()) {
			customerForm.setValid(false);
			// Forward to reenter customer info.
			// Forward tới trang nhập lại.
			return "shoppingCartCustomer";
		}

		customerForm.setValid(true);
		CartInfo cartInfo = Utils.getCartInSession(request);

		cartInfo.setCustomerInfo(customerForm);

		// Chuyển hướng sang trang xác nhận.
		return "redirect:/shoppingCartConfirmation";
	}

	// GET: Xem lại thông tin để xác nhận.
	@RequestMapping(value = { "/shoppingCartConfirmation" }, method = RequestMethod.GET)
	public String shoppingCartConfirmationReview(HttpServletRequest request, Model model) {
		CartInfo cartInfo = Utils.getCartInSession(request);

		// Chưa mua mặt hàng nào.
		if (cartInfo.isEmpty()) {

			// Chuyển tới trang danh giỏ hàng
			return "redirect:/shoppingCart";
		} else if (!cartInfo.isValidCustomer()) {

			// Chuyển tới trang nhập thông tin khách hàng.
			return "redirect:/shoppingCartCustomer";
		}

		return "shoppingCartConfirmation";
	}

	// POST: Gửi đơn hàng (Save).
	@RequestMapping(value = { "/shoppingCartConfirmation" }, method = RequestMethod.POST)

	// Tránh ngoại lệ: UnexpectedRollbackException (Xem giải thích thêm).
	@Transactional(propagation = Propagation.NEVER)
	public String shoppingCartConfirmationSave(HttpServletRequest request, Model model) {
		CartInfo cartInfo = Utils.getCartInSession(request);

		// Chưa mua mặt hàng nào.
		if (cartInfo.isEmpty()) {

			// Chuyển tới trang danh giỏ hàng
			return "redirect:/shoppingCart";
		} else if (!cartInfo.isValidCustomer()) {

			// Chuyển tới trang nhập thông tin khách hàng.
			return "redirect:/shoppingCartCustomer";
		}
		try {
			orderService.saveOrder(cartInfo);
		} catch (Exception e) {

			// Cần thiết: Propagation.NEVER?
			return "shoppingCartConfirmation";
		}

		// Xóa rỏ hàng khỏi session.
		Utils.removeCartInSession(request);

		// Lưu thông tin đơn hàng đã xác nhận mua.
		Utils.storeLastOrderedCartInSession(request, cartInfo);

		// Chuyến hướng tới trang hoàn thành mua hàng.
		return "redirect:/shoppingCartFinalize";
	}

	@RequestMapping(value = { "/shoppingCartFinalize" }, method = RequestMethod.GET)
	public String shoppingCartFinalize(HttpServletRequest request, Model model) {

		CartInfo lastOrderedCart = Utils.getLastOrderedCartInSession(request);

		if (lastOrderedCart == null) {
			return "redirect:/shoppingCart";
		}

		return "shoppingCartFinalize";
	}
}
