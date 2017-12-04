package com.example.demo.model;

public class CartLineInfo {

	private ProductInfo productInfo;
	private int quantity;

	private int maxNumberOfProduct;
	
	public CartLineInfo() {
		this.quantity = 0;
		this.maxNumberOfProduct = 0;
	}

	public CartLineInfo(ProductInfo productInfo) {
		this.productInfo = productInfo;
		this.quantity = 1;
	}
	
	public ProductInfo getProductInfo() {
		return productInfo;
	}

	public void setProductInfo(ProductInfo productInfo) {
		this.productInfo = productInfo;
	}

	public int getQuantity() {
		return quantity;
	}

	public void setQuantity(int quantity) {
		this.quantity = quantity;
	}

	public int getAmount() {
		return this.productInfo.getPrice() * this.quantity;
	}

	public boolean isProductExist(String code){
		if (productInfo.getCode().equalsIgnoreCase(code)){
			return true;
		}
		return false;
	}

	public int getMaxNumberOfProduct() {
		return maxNumberOfProduct;
	}

	public void setMaxNumberOfProduct(int maxNumberOfProduct) {
		this.maxNumberOfProduct = maxNumberOfProduct;
	}
}