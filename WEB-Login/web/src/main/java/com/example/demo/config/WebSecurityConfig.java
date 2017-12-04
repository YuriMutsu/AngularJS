package com.example.demo.config;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;

import com.example.demo.service.AuthenticationService;

@EnableWebSecurity
public class WebSecurityConfig extends WebSecurityConfigurerAdapter {
	@Autowired
	private AuthenticationService userDetailsService;

	@Bean
	public PasswordEncoder passwordEncoder() {
		return new BCryptPasswordEncoder();
	}

	@Autowired
	public void configureGlobal(AuthenticationManagerBuilder auth) throws Exception {
		// xét đặt dịch vụ để tìm kiếm User trong Database.
		// Và sét đặt PasswordEncoder.
		 auth.userDetailsService(userDetailsService).passwordEncoder(passwordEncoder());
	}

	@Override
	protected void configure(HttpSecurity http) throws Exception {
		http.csrf().disable();

		// Các yêu cầu phải login với vai trò MEMBER hoặc ADMIN.
		// Nếu chưa login, nó sẽ redirect tới trang /login.
		http.authorizeRequests()
			.antMatchers("/orderList", "/order", "/accountInfo").permitAll()
			.antMatchers("/product").hasRole("ADMIN")// Trang chỉ dành cho ADMIN;
			.antMatchers("/").permitAll()
//			.antMatchers("/addToCart").hasRole("MEMBER")
			.antMatchers("/cart").hasRole("MEMBER")
			.antMatchers("/pay").hasRole("MEMBER");

		// Khi người dùng đã login, với vai trò XX.
		// Nhưng truy cập vào trang yêu cầu vai trò YY,
		// Ngoại lệ AccessDeniedException sẽ ném ra.
		http.authorizeRequests().and().exceptionHandling().accessDeniedPage("/403");

		// Cấu hình cho Login Form.
		http.authorizeRequests().and()
			.formLogin()//
				// Submit URL của trang login
				.loginPage("/login")
				.defaultSuccessUrl("/")
				.failureUrl("/login?error=true")
				.usernameParameter("username")
				.passwordParameter("password")

				// Cấu hình cho Logout Page.
				// (Sau khi logout, chuyển tới trang home)
				.and()
			.logout()
				.logoutUrl("/logout")
				.logoutSuccessUrl("/");
	}
}