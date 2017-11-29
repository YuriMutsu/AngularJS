package com.example.demo.controller.rest;

import java.util.List;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.entity.Products;
import com.example.demo.service.ProductService;

@RestController
@RequestMapping("/rest")
public class RestProductController {

	private Logger m_logger = Logger.getLogger(RestProductController.class);
	
	@Autowired
	private ProductService productService;
	
	@RequestMapping("products")
	public ResponseEntity<List<Products>> getAllProduct(){
		List<Products> listProduct = productService.findProductAll();
		
		m_logger.info("List Products: " + listProduct.toString());
		return new ResponseEntity<List<Products>>(listProduct, HttpStatus.OK);
	}
}
