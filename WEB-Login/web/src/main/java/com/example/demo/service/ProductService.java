package com.example.demo.service;

import java.util.List;

import com.example.demo.entity.Products;
import com.example.demo.model.ProductInfo;

public interface ProductService {
	public List<Products> findProductAll();
	
	public List<ProductInfo> findProductInfoAll();
	
	public Products findProduct(String code);

	public ProductInfo findProductInfo(String code);

	public void save(ProductInfo productInfo);
}
