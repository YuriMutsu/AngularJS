package com.example.demo.model;

import java.util.Date;

import com.example.demo.entity.ProductDetails;

public class ProductDetailInfo {
	private Integer id;
	private String code;
	private String name;
	private int price;
	private byte[] image;
	private Date createDate;
	private int quantity;
	private byte[] imageViewBefore;
	private byte[] imageViewCenter;
	private byte[] imageViewAfter;
	private byte[] imageFunction;
	private String cpuTechnology;
	private String cpuType;
	private String cpuSpeed;
	private String cpuSpeedMax;
	private String cpuBusSpeed;
	private String ram;
	private String ramType;
	private String ramBusSpeed;
	private String ramMax;
	private String hardDrive;
	private String screenSize;
	private String resolution;
	private String screenTechnology;
	private String screenTouch;
	private String cardDesign;
	private String cardGraphics;
	private String audioTechnology;
	private String connector;
	private String wirelessConnectivity;
	private String memoryCardReader;
	private String opticalDrive;
	private String webcam;
	private String keyboadLight;
	private String ortherFunction;
	private String operatingSystem;
	private String pin;
	private String size;
	private String weight;
	private String meterial;
	private String trademark;
	private String describeOne;
	private String describeTwo;
	private String describeThree;
	
	public ProductDetailInfo() {
	}

	public ProductDetailInfo(String code, String productName, int productPrice, byte[] productImage,
			Date productCreateDate, int quantity, byte[] imageViewBefore, byte[] imageViewCenter, byte[] imageViewAfter,
			byte[] imageFunction, String cpuTechnology, String cpuType, String cpuSpeed, String cpuSpeedMax,
			String cpuBusSpeed, String ram, String ramType, String ramBusSpeed, String ramMax, String hardDrive,
			String screenSize, String resolution, String screenTechnology, String screenTouch, String cardDesign,
			String cardGraphics, String audioTechnology, String connector, String wirelessConnectivity,
			String memoryCardReader, String opticalDrive, String webcam, String keyboadLight, String ortherFunction,
			String operatingSystem, String pin, String size, String weight, String meterial, String trademark, String describeOne, String describeTwo, String describeThree) {
		super();
		this.code = code;
		this.name = productName;
		this.price = productPrice;
		this.image = productImage;
		this.createDate = productCreateDate;
		this.quantity = quantity;
		this.imageViewBefore = imageViewBefore;
		this.imageViewCenter = imageViewCenter;
		this.imageViewAfter = imageViewAfter;
		this.imageFunction = imageFunction;
		this.cpuTechnology = cpuTechnology;
		this.cpuType = cpuType;
		this.cpuSpeed = cpuSpeed;
		this.cpuSpeedMax = cpuSpeedMax;
		this.cpuBusSpeed = cpuBusSpeed;
		this.ram = ram;
		this.ramType = ramType;
		this.ramBusSpeed = ramBusSpeed;
		this.ramMax = ramMax;
		this.hardDrive = hardDrive;
		this.screenSize = screenSize;
		this.resolution = resolution;
		this.screenTechnology = screenTechnology;
		this.screenTouch = screenTouch;
		this.cardDesign = cardDesign;
		this.cardGraphics = cardGraphics;
		this.audioTechnology = audioTechnology;
		this.connector = connector;
		this.wirelessConnectivity = wirelessConnectivity;
		this.memoryCardReader = memoryCardReader;
		this.opticalDrive = opticalDrive;
		this.webcam = webcam;
		this.keyboadLight = keyboadLight;
		this.ortherFunction = ortherFunction;
		this.operatingSystem = operatingSystem;
		this.pin = pin;
		this.size = size;
		this.weight = weight;
		this.meterial = meterial;
		this.trademark = trademark;
		this.describeOne = describeOne;
		this.describeTwo = describeTwo;
		this.describeThree = describeThree;
	}

	public ProductDetailInfo(Integer id, String code, String productName, int productPrice,
			byte[] productImage, Date productCreateDate, int quantity, byte[] imageViewBefore, byte[] imageViewCenter,
			byte[] imageViewAfter, byte[] imageFunction, String cpuTechnology, String cpuType, String cpuSpeed,
			String cpuSpeedMax, String cpuBusSpeed, String ram, String ramType, String ramBusSpeed, String ramMax,
			String hardDrive, String screenSize, String resolution, String screenTechnology, String screenTouch,
			String cardDesign, String cardGraphics, String audioTechnology, String connector,
			String wirelessConnectivity, String memoryCardReader, String opticalDrive, String webcam,
			String keyboadLight, String ortherFunction, String operatingSystem, String pin, String size, String weight,
			String meterial, String trademark, String describeOne, String describeTwo, String describeThree) {
		super();
		this.id = id;
		this.code = code;
		this.name = productName;
		this.price = productPrice;
		this.image = productImage;
		this.createDate = productCreateDate;
		this.quantity = quantity;
		this.imageViewBefore = imageViewBefore;
		this.imageViewCenter = imageViewCenter;
		this.imageViewAfter = imageViewAfter;
		this.imageFunction = imageFunction;
		this.cpuTechnology = cpuTechnology;
		this.cpuType = cpuType;
		this.cpuSpeed = cpuSpeed;
		this.cpuSpeedMax = cpuSpeedMax;
		this.cpuBusSpeed = cpuBusSpeed;
		this.ram = ram;
		this.ramType = ramType;
		this.ramBusSpeed = ramBusSpeed;
		this.ramMax = ramMax;
		this.hardDrive = hardDrive;
		this.screenSize = screenSize;
		this.resolution = resolution;
		this.screenTechnology = screenTechnology;
		this.screenTouch = screenTouch;
		this.cardDesign = cardDesign;
		this.cardGraphics = cardGraphics;
		this.audioTechnology = audioTechnology;
		this.connector = connector;
		this.wirelessConnectivity = wirelessConnectivity;
		this.memoryCardReader = memoryCardReader;
		this.opticalDrive = opticalDrive;
		this.webcam = webcam;
		this.keyboadLight = keyboadLight;
		this.ortherFunction = ortherFunction;
		this.operatingSystem = operatingSystem;
		this.pin = pin;
		this.size = size;
		this.weight = weight;
		this.meterial = meterial;
		this.trademark = trademark;
		this.describeOne = describeOne;
		this.describeTwo = describeTwo;
		this.describeThree = describeThree;
	}

	public ProductDetailInfo(ProductDetails productDetail) {
		this.id = productDetail.getId();
		this.code = productDetail.getProducts().getCode();
		this.name = productDetail.getProducts().getName();
		this.price = productDetail.getProducts().getPrice();
		this.image = productDetail.getProducts().getImage();
		this.createDate = productDetail.getProducts().getCreateDate();
		this.quantity = productDetail.getQuantity();
		this.imageViewBefore = productDetail.getImageViewBefore();
		this.imageViewCenter = productDetail.getImageViewCenter();
		this.imageViewAfter = productDetail.getImageViewAfter();
		this.imageFunction = productDetail.getImageFunction();
		this.cpuTechnology = productDetail.getCpuTechnology();
		this.cpuType = productDetail.getCpuType();
		this.cpuSpeed = productDetail.getCpuSpeed();
		this.cpuSpeedMax = productDetail.getCpuSpeedMax();
		this.cpuBusSpeed = productDetail.getCpuBusSpeed();
		this.ram = productDetail.getRam();
		this.ramType = productDetail.getRamType();
		this.ramBusSpeed = productDetail.getRamBusSpeed();
		this.ramMax = productDetail.getRamMax();
		this.hardDrive = productDetail.getHardDrive();
		this.screenSize = productDetail.getScreenSize();
		this.resolution = productDetail.getResolution();
		this.screenTechnology = productDetail.getScreenTechnology();
		this.screenTouch = productDetail.getScreenTouch();
		this.cardDesign = productDetail.getCardDesign();
		this.cardGraphics = productDetail.getCardGraphics();
		this.audioTechnology = productDetail.getAudioTechnology();
		this.connector = productDetail.getConnector();
		this.wirelessConnectivity = productDetail.getWirelessConnectivity();
		this.memoryCardReader = productDetail.getMemoryCardReader();
		this.opticalDrive = productDetail.getOpticalDrive();
		this.webcam = productDetail.getWebcam();
		this.keyboadLight = productDetail.getKeyboadLight();
		this.ortherFunction = productDetail.getOrtherFunction();
		this.operatingSystem = productDetail.getOperatingSystem();
		this.pin = productDetail.getPin();
		this.size = productDetail.getSize();
		this.weight = productDetail.getWeight();
		this.meterial = productDetail.getMeterial();
		this.trademark = productDetail.getTrademark();
		this.describeOne = productDetail.getDescribeOne();
		this.describeTwo = productDetail.getDescribeTwo();
		this.describeThree = productDetail.getDescribeThree();
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getCode() {
		return code;
	}

	public void setCode(String productCode) {
		this.code = productCode;
	}

	public String getName() {
		return name;
	}

	public void setName(String productName) {
		this.name = productName;
	}

	public int getPrice() {
		return price;
	}

	public void setProductPrice(int productPrice) {
		this.price = productPrice;
	}

	public byte[] getImage() {
		return image;
	}

	public void setImage(byte[] productImage) {
		this.image = productImage;
	}

	public Date getCreateDate() {
		return createDate;
	}

	public void setCreateDate(Date productCreateDate) {
		this.createDate = productCreateDate;
	}

	public int getQuantity() {
		return quantity;
	}

	public void setQuantity(int quantity) {
		this.quantity = quantity;
	}

	public byte[] getImageViewBefore() {
		return imageViewBefore;
	}

	public void setImageViewBefore(byte[] imageViewBefore) {
		this.imageViewBefore = imageViewBefore;
	}

	public byte[] getImageViewCenter() {
		return imageViewCenter;
	}

	public void setImageViewCenter(byte[] imageViewCenter) {
		this.imageViewCenter = imageViewCenter;
	}

	public byte[] getImageViewAfter() {
		return imageViewAfter;
	}

	public void setImageViewAfter(byte[] imageViewAfter) {
		this.imageViewAfter = imageViewAfter;
	}

	public byte[] getImageFunction() {
		return imageFunction;
	}

	public void setImageFunction(byte[] imageFunction) {
		this.imageFunction = imageFunction;
	}

	public String getCpuTechnology() {
		return cpuTechnology;
	}

	public void setCpuTechnology(String cpuTechnology) {
		this.cpuTechnology = cpuTechnology;
	}

	public String getCpuType() {
		return cpuType;
	}

	public void setCpuType(String cpuType) {
		this.cpuType = cpuType;
	}

	public String getCpuSpeed() {
		return cpuSpeed;
	}

	public void setCpuSpeed(String cpuSpeed) {
		this.cpuSpeed = cpuSpeed;
	}

	public String getCpuSpeedMax() {
		return cpuSpeedMax;
	}

	public void setCpuSpeedMax(String cpuSpeedMax) {
		this.cpuSpeedMax = cpuSpeedMax;
	}

	public String getCpuBusSpeed() {
		return cpuBusSpeed;
	}

	public void setCpuBusSpeed(String cpuBusSpeed) {
		this.cpuBusSpeed = cpuBusSpeed;
	}

	public String getRam() {
		return ram;
	}

	public void setRam(String ram) {
		this.ram = ram;
	}

	public String getRamType() {
		return ramType;
	}

	public void setRamType(String ramType) {
		this.ramType = ramType;
	}

	public String getRamBusSpeed() {
		return ramBusSpeed;
	}

	public void setRamBusSpeed(String ramBusSpeed) {
		this.ramBusSpeed = ramBusSpeed;
	}

	public String getRamMax() {
		return ramMax;
	}

	public void setRamMax(String ramMax) {
		this.ramMax = ramMax;
	}

	public String getHardDrive() {
		return hardDrive;
	}

	public void setHardDrive(String hardDrive) {
		this.hardDrive = hardDrive;
	}

	public String getScreenSize() {
		return screenSize;
	}

	public void setScreenSize(String screenSize) {
		this.screenSize = screenSize;
	}

	public String getResolution() {
		return resolution;
	}

	public void setResolution(String resolution) {
		this.resolution = resolution;
	}

	public String getScreenTechnology() {
		return screenTechnology;
	}

	public void setScreenTechnology(String screenTechnology) {
		this.screenTechnology = screenTechnology;
	}

	public String getScreenTouch() {
		return screenTouch;
	}

	public void setScreenTouch(String screenTouch) {
		this.screenTouch = screenTouch;
	}

	public String getCardDesign() {
		return cardDesign;
	}

	public void setCardDesign(String cardDesign) {
		this.cardDesign = cardDesign;
	}

	public String getCardGraphics() {
		return cardGraphics;
	}

	public void setCardGraphics(String cardGraphics) {
		this.cardGraphics = cardGraphics;
	}

	public String getAudioTechnology() {
		return audioTechnology;
	}

	public void setAudioTechnology(String audioTechnology) {
		this.audioTechnology = audioTechnology;
	}

	public String getConnector() {
		return connector;
	}

	public void setConnector(String connector) {
		this.connector = connector;
	}

	public String getWirelessConnectivity() {
		return wirelessConnectivity;
	}

	public void setWirelessConnectivity(String wirelessConnectivity) {
		this.wirelessConnectivity = wirelessConnectivity;
	}

	public String getMemoryCardReader() {
		return memoryCardReader;
	}

	public void setMemoryCardReader(String memoryCardReader) {
		this.memoryCardReader = memoryCardReader;
	}

	public String getOpticalDrive() {
		return opticalDrive;
	}

	public void setOpticalDrive(String opticalDrive) {
		this.opticalDrive = opticalDrive;
	}

	public String getWebcam() {
		return webcam;
	}

	public void setWebcam(String webcam) {
		this.webcam = webcam;
	}

	public String getKeyboadLight() {
		return keyboadLight;
	}

	public void setKeyboadLight(String keyboadLight) {
		this.keyboadLight = keyboadLight;
	}

	public String getOrtherFunction() {
		return ortherFunction;
	}

	public void setOrtherFunction(String ortherFunction) {
		this.ortherFunction = ortherFunction;
	}

	public String getOperatingSystem() {
		return operatingSystem;
	}

	public void setOperatingSystem(String operatingSystem) {
		this.operatingSystem = operatingSystem;
	}

	public String getPin() {
		return pin;
	}

	public void setPin(String pin) {
		this.pin = pin;
	}

	public String getSize() {
		return size;
	}

	public void setSize(String size) {
		this.size = size;
	}

	public String getWeight() {
		return weight;
	}

	public void setWeight(String weight) {
		this.weight = weight;
	}

	public String getMeterial() {
		return meterial;
	}

	public void setMeterial(String meterial) {
		this.meterial = meterial;
	}

	public String getTrademark() {
		return trademark;
	}

	public void setTrademark(String trademark) {
		this.trademark = trademark;
	}

	public String getDescribeOne() {
		return describeOne;
	}

	public void setDescribeOne(String describeOne) {
		this.describeOne = describeOne;
	}

	public String getDescribeTwo() {
		return describeTwo;
	}

	public void setDescribeTwo(String describeTwo) {
		this.describeTwo = describeTwo;
	}

	public String getDescribeThree() {
		return describeThree;
	}

	public void setDescribeThree(String describeThree) {
		this.describeThree = describeThree;
	}

	public void setPrice(int price) {
		this.price = price;
	}
}
