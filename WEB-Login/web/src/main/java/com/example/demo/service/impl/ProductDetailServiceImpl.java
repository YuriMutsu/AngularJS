package com.example.demo.service.impl;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.ProductDetails;
import com.example.demo.model.ProductDetailInfo;
import com.example.demo.reponsitory.ProductDetailRepository;
import com.example.demo.service.ProductDetailService;


@Service
public class ProductDetailServiceImpl implements ProductDetailService{

	@Autowired
	private ProductDetailRepository productDetailRepository;
	
	@Override
	public List<ProductDetails> findAllProductDetails() {
		return (List<ProductDetails>) productDetailRepository.findAll();
	}

	@Override
	public ProductDetails findProductDetail(int id) {
		return productDetailRepository.findOne(id);
	}

	@Override
	public ProductDetails findProductDetail(String code) {
		List<ProductDetails> listProductDetails = findAllProductDetails();
		for (ProductDetails productDetail : listProductDetails){
			if (productDetail.getProducts().getCode().equals(code)){
				return productDetail;
			}
		}
		return null;
	}

	@Override
	public ProductDetails findProductDetailByName(String name) {
		List<ProductDetails> listProductDetails = findAllProductDetails();
		for (ProductDetails productDetail : listProductDetails){
			if (productDetail.getProducts().getName().equals(name)){
				return productDetail;
			}
		}
		return null;
	}

	@Override
	public void save(ProductDetails productDetails) {
		productDetailRepository.save(productDetails);
	}

	@Override
	public List<ProductDetailInfo> findAllProductDetailsInfo() {
		List<ProductDetailInfo> listProductDetailsInfo = new ArrayList<ProductDetailInfo>();
		List<ProductDetails> listProductDetails = findAllProductDetails();
		if (listProductDetails == null){
			return null;
		}
		
		for (ProductDetails productDetail : listProductDetails){
			listProductDetailsInfo.add(new ProductDetailInfo(productDetail));
		}
		
		return listProductDetailsInfo;
	}

	@Override
	public ProductDetailInfo findProductDetailInfo(int id) {
		ProductDetails productDetail = findProductDetail(id);
		if (productDetail == null){
			return null;
		}
		ProductDetailInfo productDetailInfo = new ProductDetailInfo(productDetail);
		return productDetailInfo;
	}

	@Override
	public ProductDetailInfo findProductDetailInfo(String code) {
		ProductDetails productDetail = findProductDetail(code);
		if (productDetail == null){
			return null;
		}
		ProductDetailInfo productDetailInfo = new ProductDetailInfo(productDetail);
		return productDetailInfo;
	}

	@Override
	public ProductDetailInfo findProductDetailInfoByName(String name) {
		ProductDetails productDetail = findProductDetailByName(name);
		if (productDetail == null){
			return null;
		}
		ProductDetailInfo productDetailInfo = new ProductDetailInfo(productDetail);
		return productDetailInfo;
	}

}
