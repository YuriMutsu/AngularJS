package com.example.demo.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.entity.User;
import com.example.demo.reponsitory.UserRepository;

@Service
public class UserSerivecImp implements UserService {

	@Autowired
	private UserRepository userRepository;

	@Override
	public void save(User user) {
		userRepository.save(user);
	}

	@Override
	public void delete(int id) {
		userRepository.delete(id);
	}

	@Override
	public Iterable<User> findAll() {
		return userRepository.findAll();
	}

	@Override
	public User findById(int id) {
		return userRepository.findOne(id);
	}

	@Override
	public int count() {
		List<User> User = (List<User>) userRepository.findAll();
		return User.size();
	}

	@Override
	public boolean isExist(int id) {
		return userRepository.exists(id);
	}

	@Override
	public void update(User user) {
		User usr = findById(user.getId());
		usr.setAddress(user.getAddress());
		usr.setBirthday(user.getBirthday());
		usr.setEmail(user.getEmail());
		usr.setName(user.getName());
		usr.setPassword(user.getPassword());
		usr.setPhone(user.getPhone());
	}

	@Override
	public User findByUsername(String username) {
		List<User> listUser = (List<User>) findAll();
		for (User user : listUser){
			if (user.getUsername().equals(username)){
				return user;
			}
		}
		return null;
	}
}