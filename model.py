import pandas as pd
import numpy as np
from sklearn.tree import DecisionTreeClassifier

# Read the CSV file into a Pandas DataFrame.
df = pd.read_csv("food_wastage.csv")

# Clean the data by removing any rows with missing values.
df = df.dropna()

# Split the data into a training set and a test set.
X_train, X_test, y_train, y_test = train_test_split(df, df["food_wastage"], test_size=0.25)

# Choose a machine learning algorithm, such as a decision tree or a random forest.
clf = DecisionTreeClassifier()

# Train the model on the training set.
clf.fit(X_train, y_train)

# Evaluate the model on the test set.
score = clf.score(X_test, y_test)

# Make predictions on new data.
predictions = clf.predict(X_test)
