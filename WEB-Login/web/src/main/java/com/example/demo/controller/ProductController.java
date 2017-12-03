package com.example.demo.controller;

import java.io.IOException;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.demo.entity.Products;
import com.example.demo.model.CartInfo;
import com.example.demo.model.ProductDetailInfo;
import com.example.demo.model.ProductInfo;
import com.example.demo.service.ProductDetailService;
import com.example.demo.service.ProductService;
import com.example.demo.utils.Utils;

import static com.example.demo.contants.ResourceConstant.*;
@Controller
public class ProductController {
	
	private Logger m_logger = Logger.getLogger(ProductController.class);
	
	
	@Autowired
	private ProductService productService;

	@Autowired
	private ProductDetailService productDetailService;
	
	@RequestMapping("/productInfo")
	public String productInfo(HttpServletRequest request, HttpServletResponse response, Model model, @RequestParam("code") String code) throws IOException{
		m_logger.info("Product Code : " + code);
		ProductDetailInfo products = productDetailService.findProductDetailInfo(code);
		model.addAttribute("productInfo", products);
		String uriImg = DELIMITER + IMAGES + DELIMITER + products.getCode() + DOT + JPG;
		model.addAttribute("productInfoImage", uriImg);
		return "/productInfo";
	}
	
	// Danh sách sản phẩm.
	@RequestMapping({"/productList"})
	public String listProductHandler() {
		return "productList";
	}
	
	@RequestMapping({ "/buyProduct" })
	public String listProductHandler(HttpServletRequest request, Model model, //
			@RequestParam(value = "code", defaultValue = "") String code) {

		Products product = null;
		if (code != null && code.length() > 0) {
			product = productService.findProduct(code);
		}
		if (product != null) {

			// Thông tin giỏ hàng có thể đã lưu vào trong Session trước đó.
			CartInfo cartInfo = Utils.getCartInSession(request);

			ProductInfo productInfo = new ProductInfo(product);

			cartInfo.addProduct(productInfo, 1);
		}

		// Chuyển sang trang danh sách các sản phẩm đã mua.
		return "redirect:/shoppingCart";
	}

	@RequestMapping(value = { "/productImage" }, method = RequestMethod.GET)
	public void productImage(HttpServletRequest request, HttpServletResponse response, Model model,
			@RequestParam("code") String code) throws IOException {
		Products product = null;
		if (code != null) {
			product = this.productService.findProduct(code);
		}
		if (product != null && product.getImage() != null) {
			response.setContentType("image/jpeg, image/jpg, image/png, image/gif");
			response.getOutputStream().write(product.getImage());
		}
		response.getOutputStream().close();
	}
}
