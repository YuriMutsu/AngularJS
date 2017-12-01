package com.example.demo.service;

import java.util.List;

import com.example.demo.entity.ProductDetails;
import com.example.demo.model.ProductDetailInfo;

public interface ProductDetailService {
	public List<ProductDetails> findAllProductDetails();
	public List<ProductDetails> findAllProductDetailsByTradeMark(String tradeMark);
	public ProductDetails findProductDetail(int id);
	public ProductDetails findProductDetail(String code);
	public ProductDetails findProductDetailByName(String name);
	public void save(ProductDetails productDetails);
	
	public List<ProductDetailInfo> findAllProductDetailsInfo();
	public ProductDetailInfo findProductDetailInfo(int id);
	public ProductDetailInfo findProductDetailInfo(String code);
	public ProductDetailInfo findProductDetailInfoByName(String name);
	
	public List<ProductDetailInfo> findAllProductDetailsInfoByTradeMark(String tradeMark);
}
