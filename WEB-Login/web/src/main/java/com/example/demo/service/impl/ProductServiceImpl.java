package com.example.demo.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.Products;
import com.example.demo.model.ProductInfo;
import com.example.demo.reponsitory.ProductRepository;
import com.example.demo.service.ProductService;

@Service
public class ProductServiceImpl implements ProductService {

	@Autowired
	private ProductRepository productRepository;

	@Override
	public Products findProduct(String code) {
		List<Products> listProduct = (List<Products>) productRepository.findAll();
		for (Products product : listProduct) {
			if (product.getCode().equals(code)) {
				return product;
			}
		}
		return null;
	}

	@Override
	public ProductInfo findProductInfo(String code) {
		Products product = findProduct(code);
		if (product != null) {
			return new ProductInfo(product);
		}
		return null;
	}

	@Override
	public void save(ProductInfo productInfo) {
		Products product = new Products();

		String code = productInfo.getCode();

		boolean isNew = false;
		if (code != null) {
			product = this.findProduct(code);
		}
		if (product == null) {
			isNew = true;
			product = new Products();
			product.setCreateDate(new Date());
		}

		product.setCode(code);
		product.setName(productInfo.getName());
		product.setPrice(productInfo.getPrice());

		if (productInfo.getFileData() != null) {
			byte[] image = productInfo.getFileData().getBytes();
			if (image != null && image.length > 0) {
				product.setImage(image);
			}
		}
		if (isNew) {
			productRepository.save(product);
		}
	}

	@Override
	public List<Products> findProductAll() {
		return (List<Products>) productRepository.findAll();
	}

	@Override
	public List<ProductInfo> findProductInfoAll() {
		List<Products> listProduct = findProductAll();
		List<ProductInfo> listProductInfo = new ArrayList<>();
		for (Products product : listProduct){
			listProductInfo.add(new ProductInfo(product));
		}
		return listProductInfo;
	}

}
