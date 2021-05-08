import 'dart:math';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_login_ui/screens/quiz_screen.dart';
import 'package:flutter_login_ui/utilities/constants.dart';

class QuizScreen extends StatefulWidget {
  @override
  _QuizScreenState createState() => _QuizScreenState();
}

class _QuizScreenState extends State<QuizScreen> {

  Widget _buildOkayButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: okayButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.green,
        child: Text(
          questionArray[0].toString(),
          style: TextStyle(
            color: Colors.white,
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  Widget _buildMediumButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: mediumButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.yellow,
        child: Text(
          questionArray[1].toString(),
          style: TextStyle(
            color: Color(0xFF527DAA),
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  Widget _buildBadButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: badButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.red,
        child: Text(
          questionArray[2].toString(),
          style: TextStyle(
            color: Color(0xFF527DAA),
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  // Variables to use in the widgets
  // Stores the postion of the question array
  var arrayPostion;
  var questionArray = [];

  


  String generateNewQuestionAndAnswers(){

    // Array of questions to display to the user
    var questions = ['Pick a movie', 'Which one is your favourite colour', 'Choose and animal', 'Which console do you prefer', 'Which brand of car do you like'];
    
    // The question to display to the user
    String displayQuestion;

    // Generate a random number
    var random = new Random();

    arrayPostion = random.nextInt(questions.length);
    displayQuestion = questions[arrayPostion];


    // Get the correct answers for the correct question
    var question0Answers = ['Godzilla', 'Superman', 'Batman']; 
    var question1Answers = ['Orange', 'Purple', 'White'];
    var question2Answers = ['Penguin', 'Tiger', 'Goose'];
    var question3Answers = ['Playstation', 'Xbox', 'Wii'];
    var question4Answers = ['Toyota', 'Mitsubishi', 'Honda'];

    if (arrayPostion == 0){
      questionArray = question0Answers;
    } else if (arrayPostion == 1){
      questionArray = question1Answers;
    } else if (arrayPostion == 2){
      questionArray = question2Answers;
    } else if (arrayPostion == 3){
      questionArray = question3Answers;
    } else if (arrayPostion == 4){
      questionArray = question4Answers;
    }

    print(questionArray[0]);
    print(questionArray[1]);
    print(questionArray[2]);




    


    return displayQuestion;
  }

  void okayButton(){
    /* 
     The user is not any danger
     Get the user's contact details and send them a SMS or alert that they are okay
    */

    print("The user is okay");
    
  }

  void mediumButton(){
    /*
     The situation is okay but not too extreme
     Get the user's contact details and send them a SMS or alert that the situation may get out
     hand
    */

    print("The user is alright");

  }

  void badButton(){
    /* 
     The situation is really bad and the user may be in great danger
     Get the user's contact details and send them a SMS or alert that the situation is really not 
     good and that they may be in great danger. Possibly alert the appropriate authorities. 
    */

    print("The user is not okay");

  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: AnnotatedRegion<SystemUiOverlayStyle>(
        value: SystemUiOverlayStyle.light,
        child: GestureDetector(
          onTap: () => FocusScope.of(context).unfocus(),
          child: Stack(
            children: <Widget>[
              Container(
                height: double.infinity,
                width: double.infinity,
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Color(0xFF73AEF5),
                      Color(0xFF61A4F1),
                      Color(0xFF478DE0),
                      Color(0xFF398AE5),
                    ],
                    stops: [0.1, 0.4, 0.7, 0.9],
                  ),
                ),
              ),
              Container(
                height: double.infinity,
                child: SingleChildScrollView(
                  physics: AlwaysScrollableScrollPhysics(),
                  padding: EdgeInsets.symmetric(
                    horizontal: 40.0,
                    vertical: 120.0,
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                      Text(
                        generateNewQuestionAndAnswers(),
                        style: TextStyle(
                          color: Colors.white,
                          fontFamily: 'OpenSans',
                          fontSize: 30.0,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      SizedBox(height: 30.0),
                     _buildOkayButton(),
                      SizedBox(
                        height: 30.0,
                      ),
                      _buildMediumButton(),
                      _buildBadButton()
                     
                    ],
                  ),
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}
