package com.example.demo.service.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.Product;
import com.example.demo.model.PaginationResult;
import com.example.demo.model.ProductInfo;
import com.example.demo.reponsitory.ProductRepository;
import com.example.demo.service.ProductService;

@Service
public class ProductServiceImpl implements ProductService {

	@Autowired
	private ProductRepository productRepository;

	@Override
	public Product findProduct(String code) {
		List<Product> listProduct = (List<Product>) productRepository.findAll();
		for (Product product : listProduct) {
			if (product.getCode().equals(code)) {
				return product;
			}
		}
		return null;
	}

	@Override
	public ProductInfo findProductInfo(String code) {
		Product product = findProduct(code);
		if (product != null) {
			return new ProductInfo(product);
		}
		return null;
	}

	@Override
	public PaginationResult<ProductInfo> queryProducts(int page, int maxResult, int maxNavigationPage) {
		return null;
	}

	@Override
	public PaginationResult<ProductInfo> queryProducts(int page, int maxResult, int maxNavigationPage,
			String likeName) {
		return null;
	}

	@Override
	public void save(ProductInfo productInfo) {
		Product product = new Product();

		String code = productInfo.getCode();

		boolean isNew = false;
		if (code != null) {
			product = this.findProduct(code);
		}
		if (product == null) {
			isNew = true;
			product = new Product();
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
	public List<Product> findProductAll() {
		return (List<Product>) productRepository.findAll();
	}

	@Override
	public List<ProductInfo> findProductInfoAll() {
		List<Product> listProduct = findProductAll();
		List<ProductInfo> listProductInfo = new ArrayList<>();
		for (Product product : listProduct){
			listProductInfo.add(new ProductInfo(product));
		}
		return listProductInfo;
	}

}
