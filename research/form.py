import mechanize
from BeautifulSoup import BeautifulSoup

br = mechanize.Browser()

br.set_handle_robots(False)

br.addheaders = [("User-agent", "Mozilla/5.0")]

formbot = br.open("http://localhost:4000/wordpress_forms/onlineapplication.html")
br.select_form(nr=0)

br["username"] = "test123"
br["login_email"] = "test@test.com"
br["password"] = "test123"
br["last_name"] = "test"
br["father"] = "father_name"
br["phone"] = "1231231234"
br["mother"] = "mother_name"
br["address"] = "123 somewhere st"
br["city"] = "somewhere town"
br["email"] = "test@test.com"
br["zip"] = "12345"
br["county"] = "York"
br["start_date"] = "10/10/18"
br["end_date"] = "10/10/19"
br["years_homeschooling"] = "2"
br["primary_instructor"] = "mother_name"
br["school_district"] = "somedistrict"
br["student_1"] = "test_kid"
br["student_1_grade"] = "2"
br["student_1_age"] = "13"
br["student_1_birthdate"] = "10/10/03"
br["curriculum_student1"] = "Some smart stuff"
br.find_control("schea").items[0].selected=False
br.find_control("enchanted").items[0].selected=False
br.find_control("expedite").items[0].selected=False
br["certify_curriculum"] = "TE"
br["certify_diploma"] = "TE"
br["certify_laws"] = "TE"
br["certify_bylaws"] = "TE"

res = br.submit()

html = res.read()
soup = BeautifulSoup(html)

print(soup)
