package com.tmtai.web.banhang.thietbimaytinh.service;

import com.tmtai.web.banhang.thietbimaytinh.entity.Users;
import com.tmtai.web.banhang.thietbimaytinh.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.GrantedAuthority;
import org.springframework.security.core.authority.SimpleGrantedAuthority;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

/**
 * Created by tranm on 26-Nov-17.
 */
@Service
public class UserServiceImpl implements UserService, UserDetailsService{
    @Autowired
    UserRepository userRepository;

    @Override
    public void save(Users user) {
        if (user.getRole() == null){
            user.setRole("ROLE_MEMBER");
        }
        userRepository.save(user);
    }

    @Override
    public Users findById(int id) {
        return userRepository.findOne(id);
    }

    @Override
    public Users findByUsername(String username) {
        List<Users> all = findAll();
        for (Users user : all) {
            if (username.equals(user.getUsername())) {
                return user;
            }
        }
        return null;
    }

    @Override
    @Transactional
    public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException {
        Users user = findByUsername(username);
        if (user == null) {
            throw new UsernameNotFoundException("User not found");
        }

        Set<GrantedAuthority> grantedAuthorities = new HashSet<>();
//        Set<Roles> roles = user.getUserRoleses();
//        for (UserRoles role : roles) {
//            grantedAuthorities.add(new SimpleGrantedAuthority(role.getRoles().getName()));
//        }
        grantedAuthorities.add(new SimpleGrantedAuthority(user.getRole()));


        return new org.springframework.security.core.userdetails.User(user.getUsername(), user.getPassword(), grantedAuthorities);
    }

    @Override
    public List<Users> findAll() {
        List<Users> listAll = (List<Users>) userRepository.findAll();
        return listAll;
    }


    @Override
    public long count() {
        return findAll().size();
    }

    @Override
    public void delete(int id) {
        userRepository.delete(id);
    }

    @Override
    public void deleteAll() {
        userRepository.deleteAll();
    }

    @Override
    public boolean isExist(int id) {
        return userRepository.exists(id);
    }
}
