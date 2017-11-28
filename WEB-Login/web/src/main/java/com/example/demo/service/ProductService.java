package com.example.demo.service;

import java.util.List;

import com.example.demo.entity.Product;
import com.example.demo.model.PaginationResult;
import com.example.demo.model.ProductInfo;

public interface ProductService {
	public List<Product> findProductAll();
	
	public List<ProductInfo> findProductInfoAll();
	
	public Product findProduct(String code);

	public ProductInfo findProductInfo(String code);

	public PaginationResult<ProductInfo> queryProducts(int page, int maxResult, int maxNavigationPage);

	public PaginationResult<ProductInfo> queryProducts(int page, int maxResult, int maxNavigationPage, String likeName);

	public void save(ProductInfo productInfo);
}
