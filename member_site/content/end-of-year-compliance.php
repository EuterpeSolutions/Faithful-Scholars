<form class="form-horizontal" action="/member_site/content/end-of-year-compliance-action.php" method="post">
  <fieldset>
    <legend> End of Year Compliance </legend>
    <h4>Please initial each box to certify your compliance with the following:</h4>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial1" name="initial1" required> I, the primary parent/guardian-instructor
        hold at least a high school diploma or GED.
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial2" name="initial2" required> Student(s) has/have attended
        a minimum of 180 days of school which are recorded.
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial3" name="initial3" required>  I have maintained a plan
        book, journal <b>or</b> diary, <b><i>AND</i></b>
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial4" name="initial4" required > maintained a portfolio of
        academic work for each student, <b><i>AND</i></b>
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial5" name="initial5" required>  I have completed, and have
        on file, a semi-annual progress report, <b><i>AND</i></b>
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial6" name="initial6" required>  I have completed, and have
        on file, an end-of-year progress report, <b><i>AND</i></b>
      </div>
    </div>
    <div class="form-group">
      <div>
        <input size=5 type="initial" id="initial7" name="initial7" required> I have taught reading,
        writing, math, science and social studies, including composition
        and literature in grades 7 through 12, to my students.
      </div>
    </div>
    <fieldset>
      <legend>High School Students <b>ONLY:</b></legend>
      <div class="control-group">
        <div class="row">
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="submitted_worksheet" id="gridRadios" value="1">
              <label class="form-check-label" for="gridRadios1">
                I have submitted my student's transcript worksheet by/before June 10th.
              </label>
            </div>
            <br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="submitted_worksheet" id="gridRadios" value="0">
              <label class="form-check-label" for="gridRadios2">
                I choose not to submit my student's transcript worksheet
                by/before June 10th and understand that it may affect his/her eligibility for scholarships.
              </label>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="control-group">
        <label class="control-label">My student plans to take dual enrollment
          classes either online or a local college. Please see our
          <a href="http://www.faithfulscholars.com/dual-enrollment-information/"
          target="_top">dual enrollment information page</a></label>
          <div class="controls radio-group">
            <label class="radio">
              <input type="radio" value="1" id="yes" name="dual_enrollment">
              Yes
            </label>
            <label class="radio">
              <input type="radio" value="0" id="no" name="dual_enrollment">
              No
            </label>
          </div>
        </div>
        <br>
        By initialing the above statements and entering your full name and
        member number below, you are attesting to having all required records
        in a personal file, prepared for viewing upon request by either Faithful
        Scholars and/or the State Board of Education.
        <br>
        <br>
        <div class="form-group">
          <label for="name">Full name:</label>
          <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="name" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
        </div>
        <div class="control-group">
          <label class="control-label">I will be:</label>
          <div class="controls radio-group">
            <label class="radio form-inline">
              <input type="radio" value="renew today" id="renewtoday" name="optionsRadios">
              Renewing with Faithful Scholars today
            </label>
            <label class="radio form-inline">
              <input type="radio" value="renew later" id="renewlater" name="optionsRadios">
              Renewing with Faithful Scholars later
            </label>
            <label class="radio form-inline">
              <input type="radio" value="school name" id="schoolname" name="optionsRadios">
              Entering traditional school - Name of School:
            </label>
            <input type="school" class="form-control" id="school" placeholder="Enter school name" name="school">
            <label class="radio form-inline">
              <input type="radio" value="change" id="changing accountability associations" name="optionsRadios">
              Changing accountability associations
            </label>
            <label class="radio form-inline">
              <input type="radio" value="moving out of state" id="move" name="optionsRadios">
              Moving out of state
            </label>
          </div>
        </div>
      </fieldset>
      <div class="form-group">
        <div class="col-sm-2 mx-auto">
          <input class="btn btn-success" type="submit" name="submit" value="Submit" />
        </div>
      </div>
    </fieldset>
  </form>
