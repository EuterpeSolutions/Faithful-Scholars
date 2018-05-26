
<html>
<body>
  <form class="form-horizontal" action="/pdfgen.php">
    <fieldset>
      <legend> End of Year Compliance </legend>
      <h4>Please initial each box to certify your compliance with the following:</h4>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial1"> I, the primary parent/guardian-instructor
          hold at least a high school diploma or GED.
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial2"> Student(s) has/have attended
          a minimum of 180 days of school which are recorded.
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial3">  I have maintained a plan
          book, journal <b>or</b> diary, <b><i>AND</i></b>
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial4"> maintained a portfolio of
          academic work for each student, <b><i>AND</i></b>
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial5">  I have completed, and have
          on file, a semi-annual progress report, <b><i>AND</i></b>
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial6">  I have completed, and have
          on file, an end-of-year progress report, <b><i>AND</i></b>
        </div>
      </div>
      <div class="form-group">
        <div>
          <input size=5 type="initial" id="initial7"> I have taught reading,
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
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="beforejune10">
                <label class="form-check-label" for="gridRadios1">
                  I have submitted my student's transcript worksheet by/before June 10th.
                </label>
              </div>
              <br>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="afterjune10">
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
                <input type="radio" value="yes" id="yes" name="optionsRadios">
                Yes
              </label>
              <label class="radio">
                <input type="radio" value="no" id="no" name="optionsRadios">
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
            <label for="email">Full name:</label>
            <input type="email" class="form-control" id="name" placeholder="Enter name" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <label for="email">Phone:</label>
            <input type="email" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
          </div>
          <div class="control-group">
            <label class="control-label">I will be:</label>
              <div class="controls radio-group">
                <label class="radio form-inline">
                  <input type="radio" value="renewtoday" id="renewtoday" name="optionsRadios">
                  Renewing with Faithful Scholars today
                </label>
                <label class="radio form-inline">
                  <input type="radio" value="renewlater" id="renewlater" name="optionsRadios">
                  Renewing with Faithful Scholars later
                </label>
                <label class="radio form-inline">
                  <input type="radio" value="schoolname" id="schoolname" name="optionsRadios">
                  Entering traditional school - Name of School:
                </label>
                <input type="school" class="form-control" id="school" placeholder="Enter school name" name="school">
                <label class="radio form-inline">
                  <input type="radio" value="change" id="change" name="optionsRadios">
                   Changing accountability associations
                </label>
                <label class="radio form-inline">
                  <input type="radio" value="move" id="move" name="optionsRadios">
                  Moving out of state
                </label>
              </div>
            </div>
        </fieldset>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </fieldset>
    </form>
  </body>
  </html>
